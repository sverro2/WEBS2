<?php
class category extends controller {

	function show($url)
	{
		$data = $this->LoadModel("model_category")->get_all_by_url($url);
		$this->LoadView("pages/category", $data);
	}

	function product($id)
	{
		$data = $this->LoadModel("model_product")->get_details($id);
		$this->LoadView("pages/product", $data);
	}
}
