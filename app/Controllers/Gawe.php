<?php

namespace App\Controllers;

use CodeIgniter\Database\Query;

class Gawe extends BaseController
{
    public function index()
    {
        $builder = $this->db->table('gawe');
        $query   = $builder->get()->getResult();
        $data['gawe'] = $query;
        return view('gawe/get' , $data);
    }
    
    public function create()
    {
        return view('gawe/add');
    }

    public function store()
    {
        $validate = $this->validate([
            'name_gawe' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nama Gawe Tidak Boleh Kosong !',
                    'min_length' => 'Masukan Minimal 3 Huruf !',
                ],
            ],
            'date_gawe' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Gawe Tidak Boleh Kosong !',
                ],
            ],
        ]);
        if(!$validate) {
            return redirect()->back()->withInput();
        }
        $data = $this->request->getPost();

        $this->db->table('gawe')->insert($data);

        if($this->db->affectedRows() > 0) {
            return redirect()->to(site_url('gawe'))->with('success', 'Data Berhasil Disimpan');
        }
    }

    public function edit($id = null) 
    {
        if($id != null) {
            $query = $this->db->table('gawe')->getWhere(['id_gawe' => $id]);
            if($query->resultID->num_rows > 0) {
                $data['gawe'] = $query->getRow();
                return view('gawe/edit', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update($id)
    {
        $validate = $this->validate([
            'name_gawe' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nama Gawe Tidak Boleh Kosong !',
                    'min_length' => 'Masukan Minimal 3 Huruf !',
                ],
            ],
            'date_gawe' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Gawe Tidak Boleh Kosong !',
                ],
            ],
        ]);
        if(!$validate) {
            return redirect()->back()->withInput();
        }
        $data = $this->request->getPost();
        unset($data['_method']);

        $this->db->table('gawe')->where(['id_gawe' => $id])->update($data);
        return redirect()->to(site_url('gawe'))->with('success', 'Data Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $this->db->table('gawe')->where(['id_gawe' => $id])->delete();
        return redirect()->to(site_url('gawe'))->with('success', 'Data Berhasil Dihapus');
    }
}
