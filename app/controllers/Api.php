<?php
class Api extends Controller
{
	private $data;
	private $username;
	private $unit;
	private $level;

	public function __construct()
	{
		if (!isset($_SESSION['user'])) {
			$this->redirect('login');
		}

		$this->username = $_SESSION['user'];
		$this->unit = $this->model('UserModel')->getUnitByUsername($this->username);
		$this->level = $this->model('UserModel')->getLevelByUsername($this->username);

		$this->data = [
			'css' => ['Dashboard/Style.css', 'Dashboard/Peminjaman.css'],
			'js' => ['Dashboard/Main.js'],
			'user' => $this->username,
			'unit' => $this->unit,
			'level' => $this->level
		];
	}

	public function index()
	{
		$this->redirect('user');
	}

	public function search_all_peminjaman()
	{
		if (!isset($_POST['search']) || !isset($_POST['limit'])) {
			$this->redirect('user/all-peminjaman');
		}

		$search = $_POST['search'];
		$_SESSION['search_all'] = $search;

		$start = 0;
		$limit = (int) $_POST['limit'];
		$totalRows = (int) $this->model('PeminjamanModel')->countSearchAllPeminjaman($search);

		if ($limit == -1) {
			$limit = $totalRows;
		}

		$this->data['totalRows'] = $totalRows;
		$this->data['totalHalaman'] = ceil($totalRows / $limit);
		$this->data['numStart'] = ($totalRows > 0) ? $start + 1 : 0;
		$this->data['currPage'] = 1;
		$this->data['peminjaman'] = $this->model('PeminjamanModel')->searchAllPeminjaman($search, $start, $limit);

		$this->helper('Dashboard/allPeminjaman', $this->data);
	}

	public function search_my_peminjaman()
	{
		if (!isset($_POST['search']) || !isset($_POST['limit'])) {
			$this->redirect('user/my-peminjaman');
		}

		$search = $_POST['search'];
		$_SESSION['search_my'] = $search;

		$start = 0;
		$limit = (int) $_POST['limit'];
		$totalRows = (int) $this->model('PeminjamanModel')->countSearchMyPeminjaman($search, $this->unit);

		if ($limit == -1) {
			$limit = $totalRows;
		}

		$this->data['totalRows'] = $totalRows;
		$this->data['totalHalaman'] = ceil($totalRows / $limit);
		$this->data['numStart'] = ($totalRows > 0) ? $start + 1 : 0;
		$this->data['currPage'] = 1;
		$this->data['peminjaman'] = $this->model('PeminjamanModel')->searchMyPeminjaman($search, $start, $limit, $this->unit);

		$this->helper('Dashboard/myPeminjaman', $this->data);
	}

	// Get Ruang Available
	public function get_avail_ruang($tgl = null, $sesi = null)
	{
		if (is_null($tgl) || is_null($sesi)) {
			$this->redirect('user/tambah-peminjaman');
		}

		$ruang = $this->model('RuangModel')->getAvailRuang($tgl, $sesi);
		echo json_encode($ruang);
	}
}