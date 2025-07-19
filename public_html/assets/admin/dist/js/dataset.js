jQuery(document).ready(function($) {
  "use strict"

  //When select province
  $('#provinsi').on('change', function (e){
      e.preventDefault();
      loadKabupaten();
  });

  //When select kabupaten
  $('#kabupaten').on('change', function (e){
    e.preventDefault();
    loadKecamatan();
  });

  function loadKabupaten() {
    var id_provinsi = $('#provinsi').val();
    $('#kabupaten').html('');

    $.ajax({
      url: base_url + 'admin/dataset/kabupaten/'+id_provinsi,
      dataType: 'json',
      success:
        function(data) {
          var option = '';
          $.each(data, function(i, object) {
              option = option + '<option value="'+object.id+'">'+object.nama+'</option>';
          });
        
          $("#kabupaten").html(option); 
          loadKecamatan();
        }
    })
  }

  function loadKecamatan() {
    var id_kabupaten = $('#kabupaten').val();
    $('#kecamatan').html('');

    $.ajax({
      url: base_url + 'admin/dataset/kecamatan/'+id_kabupaten,
      dataType: 'json',
      success:
        function(data) {
          var option = '';
          $.each(data, function(i, object) {
              option = option + '<option value="'+object.id+'">'+object.nama+'</option>';
          });
        
          $("#kecamatan").html(option); 
        }
    })
  }

  $('#tipe').on('change', function (e){
    if($(this).val() == 'sewa') {
      $('.jenis-sewa').show('slow');
    } else {
      $('.jenis-sewa').hide('slow');
    } 
  });

}); //End



  