<?php
$this->load->view('layout/head');
?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php
		$this->load->view('layout/header');
		$this->load->view('layout/leftbar');
		?>
  	<div class="content-wrapper">
	    <section class="content-header">
      	<h1>List Master Data Unit</h1>
      	<ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	        <li><a href="#">Master</a></li>
	        <li class="active">Unit</li>
      	</ol>
	    </section>

  		<section class="content">
  			<div class="row">
    			<div class="col-md-12">
    				<div class="box">
      				<div class="box-header with-border">
      					<button id="add" type="button" class="btn bg-gray-active"><i class="fa fa-plus-square-o"></i> Tambah</button>
      				</div>
      				<div class="box-body table-responsive">
      					<table id="example1" class="table table-bordered table-hover">
                  <thead>
          					<tr>
          						<th style="width: 30px">#</th>
          						<th>Nama</th>
          						<th style="width: 150px">Aksi</th>
          					</tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($rows as $key => $value) {
                      ?>
            					<tr>
            						<td><?php echo $no++;?></td>
            						<td><?php echo $value->nama;?></td>
            						<td>
                          <button type="button" onclick="edit(<?php echo $value->id;?>);" class="btn btn-sm bg-teal-active">
                            <i class="fa fa-pencil-square-o"></i> Edit</button> 
                          <button type="button" onclick="hapus(<?php echo $value->id;?>);" class="btn btn-sm bg-red-active">
                            <i class="fa fa-trash-o"></i> Hapus</button>
                        </td>
            					</tr>
                    <?php
                    }
                    ?>
                  </tbody>
      					</table>
      				</div>
              <!--<div class="box-footer clearfix">
                <?php echo $pagination;?>
              </div>-->
    				</div>
    			</div>
  			</div>
  		</section>
		</div>
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Form Master Data Unit</h4>
          </div>
          <div class="modal-body">
            <div id="alert" class="alert" style="display: none;">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Pesan!</h4>
                <span></span>
            </div>
            <form class="form-horizontal">
              <div class="form-group">
                <label for="unit" class="col-sm-2 control-label">Nama Unit</label>
                <div class="col-sm-10">
                  <input type="hidden" id="id" value="0">
                  <input type="text" class="form-control" id="nama" placeholder="Nama Unit">
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button id="save" type="button" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal modal-danger fade" id="modal-alert">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Pesan</h4>
          </div>
          <div class="modal-body">
            <p id="pesan"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
		<?php
		$this->load->view('layout/footer');
		?>
	</div>
	<?php
	$this->load->view('layout/js');
	?>
<script src="<?php echo base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(document).ready(function () {
    $('#example1').DataTable();
    $('#add').click(function(){
      $('#save').prop('lang', 'simpan');
      $('#modal-default').modal('show');
    });
    $('#save').click(function(){
      var nama = $('#nama').val();
      if(nama === ''){
        $('#alert').removeAttr('class');
        $('#alert').addClass('alert alert-danger alert-dismissible');
        $('#alert span').html('Nama Unit masih kosong!');
        $('#alert').fadeIn(1500);
        $('#alert').fadeOut(5000);
        $('#nama').focus();
        return false;
      }
      var act = $(this).prop('lang');
      var id = $('#id').val();
      if(id == 0 && act === 'simpan'){
        var url = '<?php echo base_url();?>master/act/unit/save';
        var data = {nama : nama};
      }
      else if(id != 0 && act === 'update'){
        var url = '<?php echo base_url();?>master/act/unit/upd';
        var data = {id : id, nama : nama};
      }
      else{
        console.log('Error');
        return false;
      }
      $.post(url, data,  
        function(data) {
          $('#alert').removeAttr('class');
          if(data.result == 1){
            $('#alert').addClass('alert alert-success alert-dismissible');
            $('#nama').val('');
            loadData('unit');
          }
          else{
            $('#alert').addClass('alert alert-danger alert-dismissible');
          }
          $('#alert span').html(data.alert);
          $('#alert').fadeIn(1500);
          $('#alert').fadeOut(5000);
          $('#nama').focus();
        }, 'json')
      .fail(function() {
        $('#alert').removeAttr('class');
        $('#alert').addClass('alert alert-danger alert-dismissible');
        $('#alert span').html('Proses Simpan Error!');
        $('#alert').fadeIn(1500);
        $('#alert').fadeOut(5000);
        $('#nama').focus();
      });
    });
  });

  function edit(id){
    $.get('<?php echo base_url();?>master/act/unit/get/'+id,
      function(data) {
        if(data.result == 1){
          $('#id').val(id);
          $('#nama').val(data.nama);
          $('#save').prop('lang', 'update');
          $('#modal-default').modal('show');
        }
        else{
          $('#modal-alert').removeAttr('class');
          $('#modal-alert').addClass('modal modal-danger fade');
          $('#pesan').html(data.alert);
          $('#modal-alert').modal('show');
        }
      }, 'json');
  }

  function hapus(id){
    if(confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')){
      $.get('<?php echo base_url();?>master/act/unit/del/'+id,
        function(data) {
          if(data.result == 1){
            $('#modal-alert').removeAttr('class');
            $('#modal-alert').addClass('modal modal-success fade');
            $('#pesan').html(data.alert);
            $('#modal-alert').modal('show');
            loadData('unit');
          }
          else{
            $('#modal-alert').removeAttr('class');
            $('#modal-alert').addClass('modal modal-danger fade');
            $('#pesan').html(data.alert);
            $('#modal-alert').modal('show');
          }
        }, 'json');
    }
  }

  function loadData(table){
    $.get('<?php echo base_url();?>master/load/'+table,
      function(data) {
        $('#example1').DataTable().destroy();
        $('#example1 tbody').html(data);
        $('#example1').DataTable().draw();
      });
  }
</script>
</body>
</html>
