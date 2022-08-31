<?php
class ControllerProductCategory extends Controller {
	public function index() {
	    // Added to cart
	     
	    $this->document->addStyle('catalog/view/theme/tt_presiden1/stylesheet/product-page.css');
		// Added to cart
		
		$this->document->addStyle('catalog/view/theme/tt_presiden1/stylesheet/category.css');
		
		$device = $this->customer->getDevice();
   
        if($device == 'desktop'){
            $data['device'] = 'desktop'; 
        } else {
        	$data['device'] = 'mobile'; 
        }
        
	    $this->load->language('product/category');

		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		 

		if (isset($this->request->get['filter'])) {
			$filter = $this->request->get['filter'];
		} else {
			$filter = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.sort_order';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = (int)$this->request->get['limit'];
		} else {
			$limit = $this->config->get($this->config->get('config_theme') . '_product_limit');
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'  => $this->language->get('text_home'),
			'href'  => $this->url->link('common/home'),
			'class' => ''
		);
		
		if (isset($this->request->get['path'])) {
			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$path = '';

			$parts = explode('_', (string)$this->request->get['path']);

			$category_id = (int)array_pop($parts);

			foreach ($parts as $path_id) {
				if (!$path) {
					$path = (int)$path_id;
				} else {
					$path .= '_' . (int)$path_id;
				}

				$category_info = $this->model_catalog_category->getCategory($path_id);

				if ($category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $category_info['name'],
						'href' => $this->url->link('product/category', 'path=' . $path . $url),
			            'class' => ''
					);
				}
			}
		} else {
			$category_id = 0;
		}

        	
           

         
		$category_info = $this->model_catalog_category->getCategory($category_id);
        
		if ($category_info) {
			$this->document->setTitle($category_info['meta_title']);
			$this->document->setDescription($category_info['meta_description']);
			$this->document->setKeywords($category_info['meta_keyword']);

			$data['heading_title'] = $category_info['name'];
			$data['category_id'] = $category_id;

			$banners = $this->model_catalog_category->getCategorySliderByCategoryId($category_id);
			
			$data['banners'] = array();
			    
			foreach ($banners as $banner) {
				if ($banner['image']) {
					$image = $this->model_tool_image->resize($banner['image'], 1920, 320);
				} 
				
				if ($banner['mobile_image']) {
					$mobile_image = $this->model_tool_image->resize($banner['mobile_image'], 1920, 836);
				} 
				 
				  
			    $data['banners'][] = array(
    		        'thumb'         => $image,
    		        'mobile_thumb'  => $mobile_image,
    		        'link'          => $banner['link'],
    			);
		    }
		

			$data['text_refine'] = $this->language->get('text_refine');
			$data['text_empty'] = $this->language->get('text_empty');
			$data['text_quantity'] = $this->language->get('text_quantity');
			$data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$data['text_model'] = $this->language->get('text_model');
			$data['text_price'] = $this->language->get('text_price');
			$data['text_tax'] = $this->language->get('text_tax');
			$data['text_points'] = $this->language->get('text_points');
			$data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
			$data['text_sort'] = $this->language->get('text_sort');
			$data['text_limit'] = $this->language->get('text_limit');

			$data['button_cart'] = $this->language->get('button_cart');
			$data['button_wishlist'] = $this->language->get('button_wishlist');
			$data['button_compare'] = $this->language->get('button_compare');
			$data['button_continue'] = $this->language->get('button_continue');
			$data['button_list'] = $this->language->get('button_list');
			$data['button_grid'] = $this->language->get('button_grid');

			// Set the last category breadcrumb
			$data['breadcrumbs'][] = array(
				'text'  => $category_info['name'],
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path']),
			    'class' => ''
			);
			
			$data['category_strip_desktop'] = $this->model_tool_image->resize('catalog/Banner/hp-brand-store-desktop.jpg', 1920, 100);
			$data['category_strip_mobile'] = $this->model_tool_image->resize('catalog/Banner/hp-brand-store-mobile.jpg', 1920, 400);

			/*if ($category_info['top_image']) {
				$data['thumb'] = $this->model_tool_image->resize($category_info['top_image'],1920, 320);
			} else {*/
				$data['thumb'] = '';
			/*}*/
			
			$data['slider_daily_dose_trail_mix_desktop'] = $this->model_tool_image->resize('catalog/Banner/shopnow-slider-daily-dose-trail-mix-desktop.jpg', 1920, 320);
			$data['true_10_desktop'] = $this->model_tool_image->resize('catalog/Banner/true_10-desktop.jpg', 1920, 320);
			$data['slider_raw_honey_desktop'] = $this->model_tool_image->resize('catalog/Banner/shopnow-slider-desktop-11.jpg', 1920, 320);
			
			$data['true_10_mobile'] = $this->model_tool_image->resize('catalog/Banner/true_10-mobile.jpg', 1920, 836);
			$data['slider_daily_dose_trail_mix_mobile'] = $this->model_tool_image->resize('catalog/Banner/shopnow-slider-daily-dose-trail-mix-mobile.jpg', 1920, 836);
			$data['slider_raw_honey_mobile'] = $this->model_tool_image->resize('catalog/Banner/shopnow-slider-mobile-11.jpg', 1920, 836);
			
			// New Banners 08 May 2021
			$data['slider_raw_honey_new_desktop'] = $this->model_tool_image->resize('catalog/Banner/desktop/shop-by-category-raw-honey-desktop.jpg', 1920, 320);
			$data['slider_crunchy_nuts_berries_muesli_desktop'] = $this->model_tool_image->resize('catalog/Banner/desktop/shop-by-category-crunchy-nuts-berries-muesli-desktop.jpg', 1920, 320);
			$data['slider_quinoa_desktop'] = $this->model_tool_image->resize('catalog/Banner/desktop/shop-by-category-quinoa-desktop.jpg', 1920, 320);
			
			$data['slider_raw_honey_new_mobile'] = $this->model_tool_image->resize('catalog/Banner/mobile/shop-by-category-raw-honey-mobile.jpg', 1920, 836);
			$data['slider_crunchy_nuts_berries_muesli_mobile'] = $this->model_tool_image->resize('catalog/Banner/mobile/shop-by-category-crunchy-nuts-berries-muesli-mobile.jpg', 1920, 836);
			$data['slider_quinoa_mobile'] = $this->model_tool_image->resize('catalog/Banner/mobile/shop-by-category-quinoa-mobile.jpg', 1920, 836);
			
			// New Banners 18 june 2021
			$data['shop_by_category_desktop_1'] = $this->model_tool_image->resize('catalog/Banner/desktop/millets-desktop.jpg', 1920, 320);
			$data['shop_by_category_desktop_2'] = $this->model_tool_image->resize('catalog/Banner/desktop/fibre-rich-desktop.jpg', 1920, 320);
			$data['seeds_nuts_desktop_1'] = $this->model_tool_image->resize('catalog/Banner/desktop/seeds-nuts-desktop.png', 1920, 320);
			
			$data['shop_by_category_mobile_1'] = $this->model_tool_image->resize('catalog/Banner/mobile/millets-mobile.jpg', 1920, 836);
			$data['shop_by_category_mobile_2'] = $this->model_tool_image->resize('catalog/Banner/mobile/fibre-rich-mobile.jpg', 1920, 836);
			$data['seeds_nuts_mobile_1'] = $this->model_tool_image->resize('catalog/Banner/mobile/seeds-nuts-mobile.png', 1920, 836);
			
			// New Banners 08 Oct 2021
			
			$data['slider_protein_packed_mobile'] = $this->model_tool_image->resize('catalog/Banner/mobile/protein-packed-mobile.jpg', 1920, 836);
            $data['slider_fibre_rich_mobile'] = $this->model_tool_image->resize('catalog/Banner/mobile/fibre-rich-mobile.jpg', 1920, 836);
            $data['slider_protein_packed_desktop'] = $this->model_tool_image->resize('catalog/Banner/desktop/protein-packed-desktop.jpg', 1920, 320);
            $data['slider_fibre_rich_desktop'] = $this->model_tool_image->resize('catalog/Banner/desktop/fibre-rich-desktop.jpg', 1920, 320);
			
			// TE Labs
			
			$data['category_id'] = $category_id;
			


    		 /*if (!$this->customer->isLogged() && $category_id == '622') {
    			$this->session->data['redirect'] = $this->url->link('product/category&path=622', '', true);
    
    			$this->response->redirect($this->url->link('account/login', '', true));
    		}*/
    		 $data['top_banner_desktop'] = $this->model_tool_image->resize('catalog/New/te-labs/te-labs-energy-boosters-top-desktop.jpg', 1920, 320);
            $data['top_banner_mobile'] = $this->model_tool_image->resize('catalog/New/te-labs/te-labs-energy-boosters-top-mobile.jpg', 1920, 836);
                
                
            if ($category_info['banner_desktop']) {
				$data['banner_desktop'] = $this->model_tool_image->resize($category_info['banner_desktop'],1920, 320);
			} else {
				$data['banner_desktop'] = $this->model_tool_image->resize('catalog/New/te-labs/te-labs-energy-boosters-top-desktop.jpg', 1920, 320);
			}
			
			if ($category_info['banner_mobile']) {
				$data['banner_mobile'] = $this->model_tool_image->resize($category_info['banner_mobile'],1920, 836);
			} else {
				$data['banner_mobile'] = $this->model_tool_image->resize('catalog/New/te-labs/te-labs-energy-boosters-top-mobile.jpg', 1920, 836);
			}
			
		    $data['customer_group_id'] = $customer_group_id = $this->customer->getGroupId();
            $data['customer_id'] = $this->customer->getId();
            $data['is_logged'] = $this->customer->isLogged();
            
            /*phonepe offers*/
            if($category_id == '663') {

        		$offer_page_categories = $this->model_catalog_category->getOfferPageCategories();
    
        		foreach ($offer_page_categories as $offer_page_category) {
        			$data['offer_page_categories'][$offer_page_category['category_id']] = array(
        				'category_id'   => $offer_page_category['category_id'],
                        'sub_category'  => $offer_page_category['sub_category'],
        				'main_category' => $offer_page_category['main_category']
        			);
        		}
                $data['offer_page_main_categories'] = $this->model_catalog_category->getOfferPageMainCategories();
            }


           

    		/*phonepe offers end*/
            
			if($category_id == '622') {
			    $data['top_image'] = $category_info['image'];
                $this->load->model('account/customer');
                $data['action'] = $this->url->link('product/category/applytelabs', '', true);
                
                //$data['success'] = $this->session->data['success']?$this->session->data['success']:''; 
                $data['applied'] = $this->model_account_customer->getTotalTELabsCustomersByID($this->customer->getId());
                $discounts = $this->config->get('total_customer_group_discount_customer_group_id');
                $data['discount_per'] = $discount_per = 0; /*$discounts[$customer_group_id];*/
            } else {
                $data['discount_per'] = $discount_per = 0;
            }
            
            // TE Labs
			$data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
			$data['compare'] = $this->url->link('product/compare');

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
            
            
			$data['categories'] = array();

			$results = $this->model_catalog_category->getCategories($category_id);
			
			
            $data['shop_categoris'] = $this->model_catalog_category->getShopCategories();
            
        
			foreach ($results as $result) {
				$filter_data = array(
					'filter_category_id'  => $result['category_id'],
					'filter_sub_category' => true
				);
				
				if ($result['image']) {
    				$image = $this->model_tool_image->resize($result['image'], 400, 400);
    			} else {
    				$image = '';
    			}

				$data['categories'][] = array(
					'name' => $result['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
					'image' => $image,
					'shop_by_category_id' => $result['shop_by_category_id'],
					'href' => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '_' . $result['category_id'] . $url)
				);
			}
			
			
			
			$deal_data = array();
		    $deals_filter_data = array(
		        'start' => 0,
		        'limit' => 100    
		    );
		    
		    $active_deals = $this->model_catalog_product->getDeals($deals_filter_data);
            if($active_deals) {
                foreach($active_deals AS $deal) {
                    $deal_data[$deal['product_id']] = $deal['coupon'];
                }
            }

			$data['products'] = array();

			$profilter_data = array(
				'filter_category_id' => $category_id,
				'filter_filter'      => $filter,
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);
			
            
			$proresults = $this->model_catalog_product->getProducts($profilter_data);
			
            $product_total = $this->model_catalog_product->getTotalProducts($profilter_data);
            
            
            if($category_id == '622'){
                
    		
    		if (file_exists('catalog/view/theme/default/stylesheet/animate.css')) {
    			$this->document->addStyle('catalog/view/theme/default/stylesheet/animate.css');
    		} else {
    			$this->document->addStyle('catalog/view/theme/default/stylesheet/animate.css');
    		}
    		
    		
    		$this->load->model('tool/image');
    		
			//notify
        }
           
            
			foreach ($proresults as $proresult) {
			    
			     
            if($category_info['is_custom'] == '1' && $category_info['category_id'] == 640) {
                //print_r($proresult['product_id'] . "<br>");
            }
            
				if ($proresult['image']) {
					$image = $this->model_tool_image->resize($proresult['image'], $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
				}
				
				if ($proresult['te_lab_product_image']) {
					$te_lab_product_image = $this->model_tool_image->resize($proresult['te_lab_product_image'], $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
				} else {
					$te_lab_product_image = $this->model_tool_image->resize($proresult['image'], $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
				} 
				
				if ($proresult['te_lab_image']) {
					$te_lab_image = $this->model_tool_image->resize($proresult['te_lab_image'], 1500, 980);
				} else {
					$te_lab_image = '';
				}
				
				if ($proresult['custom_image']) {
					$custom_image = $this->model_tool_image->resize($proresult['custom_image'], 1050, 890);
				} else {
					$custom_image = '';
				}
				

				if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($proresult['price'], $proresult['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
					$price11 = $this->tax->calculate($proresult['price'], $proresult['tax_class_id'], $this->config->get('config_tax'));
					$disc_per = $price11 * 20/100;
					$price11 = $price11 - $disc_per;
				} else {
					$price = false;
				}
				
				$base_option_special_price = $this->model_catalog_product->getFirstProductOptionValue($proresult['product_id']);
                
				if ((float)$proresult['special']) {
					$special = $this->currency->format($this->tax->calculate($proresult['special'], $proresult['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					if($base_option_special_price != 0) {
				        $special = $this->currency->format($this->tax->calculate($proresult['price'] + $base_option_special_price, $proresult['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				    } else {
					    $special = false;
				    }
				}
				
				if($discount_per > 0) {
				    $special = $this->currency->format($this->tax->calculate(($proresult['price'] - ($proresult['price'] * $discount_per / 100)), $proresult['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$proresult['special'] ? $proresult['special'] : $proresult['price'], $this->session->data['currency']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = (int)$proresult['rating'];
				} else {
					$rating = false;
				}
				
				$options = NULL;
				if($proresult['product_type'] != 5) {
				    $options = $this->model_catalog_product->getProductOptions($proresult['product_id']);
				} else {
					$price = false;
				}
				
				$max_per_discount = $this->model_catalog_product->getProductMaxDiscount($proresult['product_id']);
				if($max_per_discount > 2) {
				    $max_per_discount = 'Upto ' . $max_per_discount . '% Off';
				} else if($max_per_discount == 2) {
				    $max_per_discount = '2% Off';
				} else {
				    $max_per_discount = '';
				}
				
				/*$percent = 0;
				if($proresult['special'] > 0) {
				    $percent = round(100 - (($proresult['special'] / $proresult['price'])) * 100 ,0 ) > 0 ? sprintf($this->language->get('%s'), (round(100 - (($proresult['special'] / $proresult['price'])) * 100 ,0 ))) . '% OFF' : '';
				}*/
				
				if(array_key_exists($proresult['product_id'],$deal_data) && $proresult['quantity'] > 0) {
		            $coupon = $deal_data[$proresult['product_id']];
		        } else {
		            $coupon = '';
		        }
		        
                if($coupon){
    		        $coupon_query = $this->db->query("SELECT type,discount FROM " . DB_PREFIX . "coupon WHERE code = '" . $coupon . "'");
    		        $type     = $coupon_query->row['type'];
    		        $discount = $coupon_query->row['discount'];
    		        
    		        $product_price = $proresult['special'] ? ($proresult['special']) : ($proresult['price']);
    		        
    		        if ($type == 'P') {
                        $current_discount = (float) ($product_price * ((float) $discount / 100));
                    } else {
                        $current_discount = (float) $discount;
                    }
                    
                    $coupon_discount = $this->currency->format(((float)$product_price - $current_discount),$currency_code);
                    
                    $coupon_discount = $this->currency->format($this->tax->calculate(($product_price - $current_discount), $proresult['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
		        } else {
		            $coupon_discount = '';
		            $discount = 0;
		        } 
		        
		        $this->load->model('catalog/review');
		        
		        $reviews = $this->model_catalog_review->getTopReviewByProductId($proresult['product_id'], ($page - 1) * 5, 5);

        		foreach ($reviews as $proresult2) {
        			$data['reviews'][] = array(
        				'author'     => $proresult2['author'],
        				'text'       => nl2br($proresult2['text']),
        				'product_id'       => ($proresult2['product_id']),
        				'rating'     => (int)$proresult2['rating'],
        				'date_added' => date($this->language->get('date_format_short'), strtotime($proresult2['date_added']))
        			);
        		}
        		
        		$telab_cat = $this->model_catalog_product->getCategory($proresult['product_id']);
        		
		        if($proresult['product_id'] > 0) {
			    	$data['products'][] = array(
			    	    'max_per_discount'      => $max_per_discount,
			    	    'price11'               => $price11,
			    		'product_id'             => $proresult['product_id'],
			    		'product_type'           => $proresult['product_type'],
			    		'category_id'            =>  $telab_cat,
			    		'offer_page_category_id' => $proresult['offer_page_category_id'],
			    		'jan'                   => $proresult['jan'],
			    		'thumb'                 => $image,
			    		'rotator_image'         => $rotator_image,
			    		'te_lab_product_image'  => $te_lab_product_image,
			    		'te_lab_image'          => $te_lab_image, 
			    		'custom_image'          => $custom_image, 
			    		'short_description'     => html_entity_decode($proresult['short'], ENT_QUOTES, 'UTF-8'),
			    		'custom_description'    => html_entity_decode($proresult['custom_description'], ENT_QUOTES, 'UTF-8'),
 		    			'name'                  => html_entity_decode(substr($proresult['name'],0,55) . ''),
 			    		'name_mobile'           => html_entity_decode(substr($proresult['name'],0,55) . ''),
 					    'stock_status'          => $proresult['quantity'] > 0 ? 'In' : 'Out',
 					    'sort_order'            => $proresult['sort_order'],
 					    'coupon'                => $coupon,
 					    'discount'              => $discount > 0 ? round($discount) : '',
 					    'coupon_discount'       => $coupon_discount,
					    'description' => utf8_substr(strip_tags(html_entity_decode($proresult['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
					    'options'               => $options,
					    'reviews'               => $proresult['reviews'],
					    'quantity'              => $proresult['quantity'],
					    'price'                 => substr($price,3) > 0 ? $price : "",
					    'price1'                => $this->load->controller('extension/module/joseanmatias_preco_cupom/listview', $proresult),
					    'special'               => $special,
 					    'tax'                   => $tax,
					    'minimum'               => $proresult['minimum'] > 0 ? $proresult['minimum'] : 1,
					    'rating'                => $proresult['rating'],
					    'reviews_count'         => $proresult['reviews'] > 0 ? $proresult['reviews'] : 0,
					    'href'                  => $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $proresult['product_id'] . $url)
				    );
		        }
			}
			/*
			if($this->customer->isLogged() == '53180') {
            print_r($data['products']);
            }*/
           
			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}
  
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['sorts'] = array();

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_default'),
				'value' => 'p.sort_order-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.sort_order&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_asc'),
				'value' => 'pd.name-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_desc'),
				'value' => 'pd.name-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=DESC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_price_asc'),
				'value' => 'p.price-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.price&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_price_desc'),
				'value' => 'p.price-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.price&order=DESC' . $url)
			);

			if ($this->config->get('config_review_status')) {
				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_desc'),
					'value' => 'rating-DESC',
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=rating&order=DESC' . $url)
				);

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_asc'),
					'value' => 'rating-ASC',
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=rating&order=ASC' . $url)
				);
			}

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_asc'),
				'value' => 'p.model-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.model&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_desc'),
				'value' => 'p.model-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.model&order=DESC' . $url)
			);

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			$data['limits'] = array();

			$limits = array_unique(array($this->config->get($this->config->get('config_theme') . '_product_limit'), 25, 50, 75, 100));

			sort($limits);

			foreach($limits as $value) {
				$data['limits'][] = array(
					'text'  => $value,
					'value' => $value,
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&limit=' . $value)
				);
			}

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$pagination = new Pagination();
			$pagination->total = $product_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->url = $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&page={page}');

			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

			// http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
			if ($page == 1) {
			    $this->document->addLink($this->url->link('product/category', 'path=' . $category_info['category_id'], true), 'canonical');
			} elseif ($page == 2) {
			    $this->document->addLink($this->url->link('product/category', 'path=' . $category_info['category_id'], true), 'prev');
			} else {
			    $this->document->addLink($this->url->link('product/category', 'path=' . $category_info['category_id'] . '&page='. ($page - 1), true), 'prev');
			}

			if ($limit && ceil($product_total / $limit) > $page) {
			    $this->document->addLink($this->url->link('product/category', 'path=' . $category_info['category_id'] . '&page='. ($page + 1), true), 'next');
			}

			$data['sort'] = $sort;
			$data['order'] = $order;
			$data['limit'] = $limit;

			$data['continue'] = $this->url->link('common/home');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');
  
			if($category_id == '622') {
			    $this->document->addStyle('catalog/view/theme/tt_presiden1/stylesheet/te-lab.css');
			    $this->response->setOutput($this->load->view('product/te_labs', $data));
			} else if($category_id == '588'){ 
			    $this->response->setOutput($this->load->view('product/breakfast', $data));
			} else if($category_id == '659'){ 
			    $this->response->setOutput($this->load->view('product/seeds_and_nuts', $data));
			} else if($category_id == '613'){	
			    $this->response->setOutput($this->load->view('product/shop_by_category', $data));
            } else if($category_id == '663') {
				$this->response->setOutput($this->load->view('product/offers.tpl', $data));
			} else if($category_info['is_custom'] == '1') {
			    $this->response->setOutput($this->load->view('product/custom_category', $data));
			    $data['top_banner_desktop'] = $this->model_tool_image->resize('/image/catalog/Banner/bakers-friendly-desktop', 1920, 320);
			} else {
			    $this->response->setOutput($this->load->view('product/category', $data));
			}  
			
		} else {
			$url = '';

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('product/category', $url),
			    'class' => ''
			);


			
		

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('error/not_found', $data));
		}
	}
	
	private function timeAgoSecondsToText($seconds) {
		$jpnl = $this->config->get('just_purchased_notification_localisation');
		$jpnl_current = $jpnl[$this->config->get('config_language_id')];
		
		$minutes = floor($seconds / 60);
		
		if ($minutes < 1) {
			$minutes = 1;
		}
		
		$hours   = floor($seconds / 60 / 60);
		$days    = floor($seconds / 60 / 60 / 24);
		
		if ( $minutes <= 59) {
			return str_replace("{time_counter}", $minutes, $jpnl_current['time_ago_minute']);
		} elseif ($hours <= 23) {
			return str_replace("{time_counter}", $hours, $jpnl_current['time_ago_hour']);
		} else {
			return str_replace("{time_counter}", $days, $jpnl_current['time_ago_day']);
		}
	}
	
	public function applytelabs() {
	    $this->load->model('account/customer');
	    
	    if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['customer_id'])) {
			$data['error_customer_id'] = $this->error['customer_id'];
		} else {
			$data['error_customer_id'] = '';
		}
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->model_account_customer->applytelabs($this->request->post);

			$this->session->data['success'] = "You have successfully applied for TE Lab Program";

			// Add to activity log
			if ($this->config->get('config_customer_activity')) {
				$this->load->model('account/activity');

				$activity_data = array(
					'customer_id' => $this->customer->getId(),
					'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
				);

				$this->model_account_activity->addActivity('te_labs_apply', $activity_data);
			}

			$this->response->redirect($this->url->link('product/category&path=622', '', true));
		}
	}
}