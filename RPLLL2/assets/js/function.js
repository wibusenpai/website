function showDataAdmin(){  
    $.ajax({
        url:"../admin/view/DataAdmin.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}
function showDataDestinasi(){  
    $.ajax({
        url:"../admin/view/DataDestinasi.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}
function showGaleriWisata(){  
    $.ajax({
        url:"../admin/view/GaleriWisata.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}
function showUlasanWisata(){  
    $.ajax({
        url:"../admin/view/UlasanWisata.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}
function showDataKuliner(){  
    $.ajax({
        url:"../admin/view/DataKuliner.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}
function showGaleriKuliner(){  
    $.ajax({
        url:"../admin/view/GaleriKuliner.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}
function showUlasanKuliner(){  
    $.ajax({
        url:"../admin/view/UlasanKuliner.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}