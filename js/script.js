$(document).ready(function(){

  $('#tombol-cari').hide();

  //event ketika keyword ditulis
  $('#keyword').on('keyup',function(){
    //munculkan icon loading

    $('.loader').show();

    //jquery menggunakan load cara 1
    //$('#container').load('ajax/mahasiswa.php?keyword='+$('#keyword').val());
    $.get('ajax/mahasiswa.php?keyword='+$('#keyword').val(),function(data){
      $('#container').html(data);
      $('.loader').hide();
    })
  })
});