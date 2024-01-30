

				$signa1 = $this->input->post('signa1');				
				$racikan1 = array(
							'pemeriksaan_id' => $pemeriksaan_id, 
							'nama_racikan'   => 'racikan 1', 								
							'signa'  => $signa1, 
							'creator	'     => $session->id

						);
				
				if ($signa1 != "") {
					$j = 0;
					$detail_obat_racikan_pemeriksaan_id = $this->MainModel->insert_id('detail_obat_racikan_pemeriksaan',$racikan1);
					$id_obat_racikan1 = $this->input->post('nama_obat_racikan1');
					$jumlah_satuan1 = $this->input->post('jumlah_satuan1');		
					foreach ($nama_obat_racikan1 as $key => $value) {
						$obat_racikan1 = array(
									'detail_obat_racikan_pemeriksaan_id' => $detail_obat_racikan_pemeriksaan_id, 
									'obat_id' =>  $value,
									'jumlah_satuan' =>  $jumlah_satuan1[$j],
									'creator	'     => $session->id
								);
						
						if ($obat_racikan1['obat_id'] != "") {
							$this->MainModel->insert('obat_racikan',$obat_racikan1);
							$obat = $this->ObatModel->getObatById($value)->row();
							$stok = array(
									
									'stok_obat'        => ($obat->stok_obat)-$jumlah_satuan1[$i], 
									

								);
							$this->MainModel->update('obat',$stok,$value);
						}		
						$j++;
					}
				}		