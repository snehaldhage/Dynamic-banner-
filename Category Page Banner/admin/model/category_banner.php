<?php
class ModelDesignCategoryBanner extends Model {
	public function addBanner($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "category_banner SET name = '" . $this->db->escape($data['name']) . "',category_id = '" .  (int)$data['category_id'] . "',status = '" . (int)$data['status'] . "'");

		$category_banner_id = $this->db->getLastId();

		if (isset($data['banner_image'])) {
			foreach ($data['banner_image'] as $language_id => $value) {
				foreach ($value as $banner_image) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "category_banner_image SET category_banner_id = '" . (int)$category_banner_id . "', language_id = '" . (int)$language_id . "', title = '" .  $this->db->escape($banner_image['title']) . "',start_date = '" .  $this->db->escape($banner_image['start_date']) . "', end_date = '" .  $this->db->escape($banner_image['end_date']) . "',status = '" .  (int)$banner_image['status'] . "',link = '" .  $this->db->escape($banner_image['link']) . "', image = '" .  $this->db->escape($banner_image['image']) . "', mobile_image = '" .  $this->db->escape($banner_image['mobile_image']) . "', sort_order = '" .  (int)$banner_image['sort_order'] . "'");
				}
			}
		}

		return $category_banner_id;
	}
  
	public function editBanner($category_banner_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "category_banner SET name = '" . $this->db->escape($data['name']) . "',category_id = '" .  (int)$data['category_id'] . "', status = '" . (int)$data['status'] . "' WHERE category_banner_id = '" . (int)$category_banner_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "category_banner_image WHERE category_banner_id = '" . (int)$category_banner_id . "'");

		if (isset($data['banner_image'])) {
			foreach ($data['banner_image'] as $language_id => $value) {
				foreach ($value as $banner_image) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "category_banner_image SET category_banner_id = '" . (int)$category_banner_id . "', language_id = '" . (int)$language_id . "', title = '" .  $this->db->escape($banner_image['title']) . "',start_date = '" .  $this->db->escape($banner_image['start_date']) . "', end_date = '" .  $this->db->escape($banner_image['end_date']) . "',status = '" .  (int)$banner_image['status'] . "', link = '" .  $this->db->escape($banner_image['link']) . "', image = '" .  $this->db->escape($banner_image['image']) . "', mobile_image = '" .  $this->db->escape($banner_image['mobile_image']) . "', sort_order = '" . (int)$banner_image['sort_order'] . "'");
				}
			}
		}
	}

	public function deleteBanner($category_banner_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "category_banner WHERE category_banner_id = '" . (int)$category_banner_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "category_banner_image WHERE category_banner_id = '" . (int)$category_banner_id . "'");
	}

	public function getBanner($category_banner_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "category_banner WHERE category_banner_id = '" . (int)$category_banner_id . "'");

		return $query->row;
	}

	public function getBanners($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "category_banner";

		$sort_data = array(
			'name',
			'status'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getBannerImages($category_banner_id) {
		$banner_image_data = array();

		$banner_image_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_banner_image WHERE category_banner_id = '" . (int)$category_banner_id . "' ORDER BY sort_order ASC");

		foreach ($banner_image_query->rows as $banner_image) {
			$banner_image_data[$banner_image['language_id']][] = array(
				'title'         => $banner_image['title'],
				'status'        => $banner_image['status'],
				'start_date'    => $banner_image['start_date'],
				'end_date'      => $banner_image['end_date'],
				'link'          => $banner_image['link'],
				'image'         => $banner_image['image'],
				'mobile_image'  => $banner_image['mobile_image'],
				'sort_order'    => $banner_image['sort_order']
			);
		}

		return $banner_image_data;
	}

	public function getTotalBanners() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "category_banner");

		return $query->row['total'];
	}

	public function getCategories(){
		
		$query = $this->db->query("SELECT c.category_id, c.status, cd.name FROM ". DB_PREFIX ."category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) WHERE c.status = 1");
		
		return $query->rows;
	}

}
 