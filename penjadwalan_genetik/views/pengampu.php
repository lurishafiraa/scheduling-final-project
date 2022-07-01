<div class="content">
   <div class="header">
      <h1 class="page-title"><?php echo $page_title;?></h1>
   </div>
   <ul class="breadcrumb">
      <li><a href="<?php echo base_url();?>">Beranda</a> <span class="divider">/</span></li>
      <li class="active"><?php echo $page_title;?></li>
   </ul>

   <div class="container-fluid">
         <?php if($this->session->flashdata('msg')) { ?>                        
            <div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">x</button>                
              <?php echo $this->session->flashdata('msg');?>
            </div>  
        <?php } ?>  

      <div class="row-fluid">
        <a href="<?php echo base_url() . 'web/pengampu_add';?>"> <button class="btn btn-primary pull-right"><i class="icon-plus"></i> Tambah Data</button></a>     

        <form class="form" method="POST" action="<?php echo base_url() . 'web/pengampu_search'?>">
          
          <label>Semester</label>
          <select id = "semester_tipe" name="semester_tipe" class="input-xlarge" onchange="change_get()">            
            <!--<option value="1" <?php echo isset($semester_tipe) ? ($semester_tipe === '1' ? 'selected':'') : '' ;?> /> GANJIL-->
            <!--<option value="0" <?php echo isset($semester_tipe) ? ($semester_tipe === '0' ? 'selected':'') : '' ;?> /> GENAP-->
			<option value="1" <?php echo $this->session->userdata('pengampu_semester_tipe') ==='1' ? 'selected':'' ;?> /> GANJIL
            <option value="0" <?php echo $this->session->userdata('pengampu_semester_tipe') ==='0' ? 'selected':'' ;?> /> GENAP
          </select>
            
          <label>Tahun Akademik</label>
          <select id="tahun_akademik" name="tahun_akademik" class="input-xlarge" onchange="change_get()">
            <!--<option value="2015-2016" <?php echo isset($tahun_akademik) ? ($tahun_akademik === '2015-2016' ? 'selected':'') : '' ;?> /> 2015-2016-->
            <!--<option value="2016-2017" <?php echo isset($tahun_akademik) ? ($tahun_akademik === '2016-2017' ? 'selected':'') : '' ;?> /> 2016-2017-->
            <!--<option value="2017-2018" <?php echo isset($tahun_akademik) ? ($tahun_akademik === '2017-2018' ? 'selected':'') : '' ;?> /> 2017-2018-->
            <!--<option value="2018-2019" <?php echo isset($tahun_akademik) ? ($tahun_akademik === '2018-2019' ? 'selected':'') : '' ;?> /> 2018-2019-->
            <!--<option value="2019-2020" <?php echo isset($tahun_akademik) ? ($tahun_akademik === '2019-2020' ? 'selected':'') : '' ;?> /> 2019-2020-->
            <!--<option value="2020-2021" <?php echo isset($tahun_akademik) ? ($tahun_akademik === '2020-2021' ? 'selected':'') : '' ;?> /> 2020-2021-->
            <!--<option value="2021-2022" <?php echo isset($tahun_akademik) ? ($tahun_akademik === '2021-2022' ? 'selected':'') : '' ;?> /> 2021-2022-->
            
			
            <option value="2015-2016" <?php echo $this->session->userdata('pengampu_tahun_akademik') === '2015-2016' ? 'selected':'' ;?> /> 2015-2016
            <option value="2016-2017" <?php echo $this->session->userdata('pengampu_tahun_akademik') === '2016-2017' ? 'selected':'' ;?> /> 2016-2017
            <option value="2017-2018" <?php echo $this->session->userdata('pengampu_tahun_akademik') === '2017-2018' ? 'selected':'' ;?> /> 2017-2018
            <option value="2018-2019" <?php echo $this->session->userdata('pengampu_tahun_akademik') === '2018-2019' ? 'selected':'' ;?> /> 2018-2019
            <option value="2019-2020" <?php echo $this->session->userdata('pengampu_tahun_akademik') === '2019-2020' ? 'selected':'' ;?> /> 2019-2020
            <option value="2020-2021" <?php echo $this->session->userdata('pengampu_tahun_akademik') === '2020-2021' ? 'selected':'' ;?> /> 2020-2021
            <option value="2021-2022" <?php echo $this->session->userdata('pengampu_tahun_akademik') === '2021-2022' ? 'selected':'' ;?> /> 2021-2022
			
          </select>
            
          <label>Dosen / Matakuliah</label>  
          <input type="text" name="search_query" value="<?php echo isset($search_query) ? $search_query : '' ;?>">  
          
          <div class="form">
            <button type="submit" class="btn">Cari</button>
            <a href="<?php echo base_url() . 'web/pengampu';?>"><button type="button" class="btn">Clear</button> </a>
          </div>
        </form>
		
		<?php if($rs_pengampu->num_rows() === 0):?>
		<div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">�</button>             
			Tidak ada data.
        </div>  
		<?php else: ?> 
		<div id="content_ajax">
          
          <div class="pagination" id="ajax_paging">
              <ul>
                  <?php echo $this->pagination->create_links();?>
              </ul>
          </div>           

          <div class="widget-content">            
              <table class="table table-striped table-bordered">
                 <thead>
                    <tr>
					   <th>#</th>
                       <th>Matakuliah</th>
                       <th>Dosen</th>
                       <th>Kelas</th>
                       <th>Tahun Akademik</th>
                       <th style="width: 65px;"></th>
                    </tr>
                 </thead>
                 <tbody>
  
                 <?php 
                   $i =  intval($start_number) + 1;
                   foreach ($rs_pengampu->result() as $pengampu) { ?>
                   <tr<?php echo ' id="row_'.$pengampu->kode . '"';?>>
					  <td><?php echo str_pad((int)$i,3,0,STR_PAD_LEFT);?></td> 
                      <td><?php echo $pengampu->nama_mk;?></td>                    
                      <td><?php echo $pengampu->nama_dosen;?></td>
                      <td><?php echo $pengampu->kelas;?></td>
                      <td><?php echo $pengampu->tahun_akademik;?></td>
                      
                      <td>
                        <a href="<?php echo base_url() . 'web/pengampu_edit/' .$pengampu->kode;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
                        <a class="btn btn-small" onClick="delete_row('web/pengampu_delete/', <?php echo $pengampu->kode ?>)" ><i class="icon-trash"></i></a>
                      </td>
                   </tr>
                 <?php $i++;} ?>
                    
                 </tbody>
              </table>
           </div>
           
          
           <div class="pagination" id="ajax_paging">
              <ul>
                  <?php echo $this->pagination->create_links();?>
              </ul>
          </div>           
        </div>
        <?php endif; ?>
         <footer>
            <hr />
            <p class="pull-right">Design by <a href="http://www.portnine.com" target="_blank">Luri Shafira</a></p>
          <p>&copy; 2022 <a href="http://www.portnine.com" target="_blank">3121640029</a></p>
         </footer>
      </div>
   </div>
</div>