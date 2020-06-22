<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url("assets/"); ?>datatables/css/dataTables.bootstrap.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Komentar
    </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Admin</a></li>
      <li class="active">Komentar</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Komentar</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
          title="Collapse">
          <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div>
            <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
          </div><br>
          <div class="box-body table-responsive no-padding">
            <table id="mytable" class="table table-striped table-bordered table-hover" width="100%">
              <thead>
                <tr>
                  <th width="1%">No</th>
                  <th>Nama Konten</th>
                  <th>Nama Komentar</th>
                  <th>Deskripsi</th>
                  <th>Tanggal</th>
                  <th width="20%">Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>

        </div>
      </div>


      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- jQuery 3 -->
  <script src="<?= base_url("assets/"); ?>bower_components/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript">
    // Aktif Navigasi
    $(document).ready(function() {
      $('#komentar').addClass('active treeview');
    });
  </script>

  <!-- DataTables -->
  <script src="<?= base_url("assets/"); ?>datatables/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url("assets/"); ?>datatables/js/dataTables.bootstrap.js"></script>
  <script type="text/javascript">
    $(document).on('keydown', 'body', function(e){
      var charCode = ( e.which ) ? e.which : event.keyCode;

        if(charCode == 118) //F7
        {
          tambah()
          return false;
        }
      });
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
     return {
      "iStart": oSettings._iDisplayStart,
      "iEnd": oSettings.fnDisplayEnd(),
      "iLength": oSettings._iDisplayLength,
      "iTotal": oSettings.fnRecordsTotal(),
      "iFilteredTotal": oSettings.fnRecordsDisplay(),
      "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
      "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
    };
  };

  var table = $('#mytable').DataTable({
   oLanguage: {
    sProcessing: "loading..."
  },
  processing: true,
  serverSide: true,
  ajax: {"url": "<?= base_url() ?>admin/komentar/json", "type": "POST"},
  columns: [
  {
    "data": "id",
    "orderable": false
  },
  {"data": "nama_konten"},
  {"data": "nama"},
  {"data": "deskripsi"},
  {"data": "tanggal"},
  {"data": "view","orderable": false}
  ],
  order: [[4, 'asc']],
  rowCallback: function(row, data, iDisplayIndex) {
    var info = this.fnPagingInfo();
    var page = info.iPage;
    var length = info.iLength;
    var index = page * length + (iDisplayIndex + 1);
    $('td:eq(0)', row).html(index);
  }
});

    //fun reload
    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax
      }

    //Fun Hapus
    function hapus(id)
    {
      if(confirm('Anda yakin ingin menghapus data?'))
      {
            // ajax delete data to database
            $.ajax({
              url : '<?php echo site_url("admin/komentar/hapus/'+id+'") ?>',
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
                    //if success reload ajax table
                    $('#modal_form').modal('hide');
                    reload_table();
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                    alert('Error deleting data');
                  }
                });
          }
        }
      </script>