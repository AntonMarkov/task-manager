$(document).ready(function(){

    $(".btn-add").click(function(){
        $(this).hide();
        $('.form').css({"display":"block"});
    });

    $("#light_close").click(function(){
        $(".light_window").hide();
    });

    $(".close").click(function(){
      $('.btn-add').css({"display":"block"});
      $('.form').hide("slow");
    });

    $("#add_new_task").click(function(){
      $('.light_window').css({"display":"block"});
    });

  $(".menu").hide();

  $(".todo").html("TO DO");

  $(".done").html("DONE");

  $('.mark_as_done').css({"display":"block"});
  
  $(".text_input").keyup(function(){//get inputed text
     _this = this;
    $.each($(".task"), function() {//get class task and check it
      if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
       $(this).hide();
      else
       $(this).show();
    });
  });

  $('.edit').click(function(event){
    var id_edit = event.target.id;
    var idName = $("#" + id_edit + "-name").text();
    idName = idName.replace(/\s/g, '');
    $("#category").hide();
    $("#category").removeAttr("required");
    $("#submit-task").attr('name', 'btn-edit');
    $(".light_window").css({"display":"block"});
    $("#task_name").val(idName);
    $("#task_id").val(id_edit);
  });

  $('.editlist').click(function(event){
    var id_list = $(this).attr("id");;
    var idName = $("#" + id_list + "-name-list").text();
    idName = idName.replace(/\s/g, '');
    $("#submit").attr('name', 'btn-edit-list');
    $(".btn-add").hide();
    $("#submit").show();
    $('.form').css({"display":"block"});
    $("#list_name").val(idName);
    $("#list_id").val(id_list);
  });

  setTimeout(function () {
    $(".loader").hide();
  }, 10000);

  $('.none').click(function(){
    $('.fa-bars').hide();
    $(".menu").show();
  });
});
$(document).mouseup(function (e)
{
  var cs = $(".menu");
  if (!cs.is(e.target) && cs.has(e.target).length === 0)
  {
    cs.hide();
    $('.fa-bars').show();
  }
});
