/* 
  Al seleccionar el Tipo de Modelo del Procesador (Cpu), 
  mostrar el listado de Modelos de Cpus 
*/
$(document).on('change', 'select[name=model_type]', function() {
  console.log('Esta escuchando!');

  var model_type = $(this).val().trim();
  var select_prototype = $('select[name="prototype_id"]');
  select_prototype.empty();

  if (model_type) {
    console.log('Tipo de modelo => ', model_type);

    $.ajax({
      url:      '/admin/procesadores/getPrototypes',
      data:     { "model_type": model_type },
      dataType: 'json',
      success:  function(data) {
        console.table(data);

        select_prototype.append($('<option>', {
          value: 0,
          text: "Seleccionar un Modelo"
        }));

        $.each(data.prototypeList, function(index, value) {
          select_prototype.append('<option value="'+ index +'">'+ value +'</option>');
        });
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.responseText);
      }
    });
  } else {
    select_prototype.empty();
  };
});

/* Registos adicionales: N° de Oficina, Memorias y Disco Duros
  https://bootsnipp.com/snippets/ykXa
  https://makitweb.com/create-duplicate-of-the-elements-with-clone-jquery/
*/
var field_selected = [];

$(function() {
  $(document).on('click', '.btn-add-field', function(e) {
    e.preventDefault();

    var controlForm  = $('.controlsField div:first'),
        currentEntry = $(this).parents('.entryField:first'),
        newEntry = $(currentEntry.clone()).appendTo(controlForm);
    
    newEntry.find('input').val('');
    controlForm.find('.entryField:not(:last) .btn-add-field')
        .removeClass('btn-add-field').addClass('btn-remove')
        .removeClass('btn-success').addClass('bg-red-600 hover:bg-red-500 focus:border-red-700 focus:ring-red-200')
        .html('<i class="fas fa-minus"></i>');
  }).on('click', '.btn-remove', function(e) {
    $(this).parents('.entryField:first').remove();
    e.preventDefault();
    return false;
  });
});

// Evitar seleccionar registros duplicadas
$(document).on('change', '.fieldDouble', function () {
  var selected = $(this).val();

  if(!field_selected.includes(selected)) {
      field_selected.push(selected);
  } else {
      Swal.fire({
        icon:   'error',
        title:  'El registro ya ha sido seleccionado!',
        text:   'Por favor seleccione otro!',
        button: 'Ok!',
      });
      $(this).val("");
  }
});

/* Registos adicionales: Memorias y Disco Duros
  https://www.youtube.com/watch?v=uzil832QlqQ
*/
$(function() {
  $('.addBtn').click(function(e) {
    var rowHtml = $(this).parents("tr").clone();
    // rowHtml.find("input[type=text]").val("");
    rowHtml.find("input").val("");
    rowHtml.find("select").val("");
    rowHtml.insertAfter($(this).parents("tr"));
  });

  $('.removeBtn').click(function(e) {
    /* if ($(this).parents("tr").siblings().length > 1) {
      $(this).parents("tr").remove();
    } else {
      alert("No se pueden eliminar todas las filas.");
    } */
    $(this).parents("tr").remove();
  });
});