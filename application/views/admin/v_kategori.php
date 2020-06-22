<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url("assets/"); ?>datatables/css/dataTables.bootstrap.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Kategori
    </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Admin</a></li>
      <li class="active">Kategori</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Kategori</h3>

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
            <button class="btn btn-primary" onclick="tambah()"><span class="fa fa-edit"></span> Tambah (F7)</button>
            <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
          </div><br>
          <div class="box-body table-responsive no-padding">
            <table id="mytable" class="table table-striped table-bordered table-hover" width="100%">
              <thead>
                <tr>
                  <th width="1%">No</th>
                  <th>Kategori</th>
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
      $('#kategori').addClass('active treeview');
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
  ajax: {"url": "<?= base_url() ?>admin/kategori/json", "type": "POST"},
  columns: [
  {
    "data": "id",
    "orderable": false
  },
  {"data": "nama"},
  {"data": "view","orderable": false}
  ],
  order: [[1, 'asc']],
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
              url : '<?php echo site_url("admin/kategori/hapus/'+id+'") ?>',
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

    //fun tambah
    function tambah()
    {
      save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Kategori'); // Set Title to Bootstrap modal title
      }

    //fun edit
    function edit(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $.ajax({
      url : '<?php echo site_url("admin/kategori/edit/'+id+'") ?>',
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        $('[name="id"]').val(data.id);
        $('[name="nama"]').val(data.nama);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Kategori'); // Set title to Bootstrap modal title
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert('Error get data from ajax');
          }
        });
  }

    //fun simpan
    function save()
    {
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;

    if(save_method == 'add') {
      url = "<?php echo site_url('admin/kategori/tambah')?>";
    } else {
      url = "<?php echo site_url('admin/kategori/update')?>";
    }

    // ajax adding data to database
    var formData = new FormData($('#form')[0]);
    $.ajax({
      url : url,
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",

      success: function(data)
      {
            if(data.status) //if success close modal and reload ajax table
            {
              $('#modal_form').modal('hide');
              reload_table();
            } else
            {
              for (var i = 0; i < data.inputerror.length; i++)
              {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                  }
                }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
          }
        });
  }
</script>

<!--modal tambah dan edit -->
<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"></h3>
      </div>
      <form action="#" id="form" class="form-horizontal">
        <div class="modal-body form">
          <div class="modal-body">
            <input type="hidden" value="" name="id"/>
            <div class="form-group">
              <label>Kategori</label>
              <input type="text" class="form-control" placeholder="Kategori" name="nama" required/>
              <span class="help-block"></span>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="pull-right">
            <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary"><i class="fa fa-mail-forward "></i> Save</button>
          </div>
          <div class="pull-left">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-mail-reply"></i> Cancel</button>
          </div>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
