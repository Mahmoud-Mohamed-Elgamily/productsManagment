window.addEventListener('DOMContentLoaded', function () {

  let container = $('#extraContent');
  // container.css('display', 'block');

  $("#criteria_id").on('change', function () {
    let criteriaId = $(this).children("option:selected").val();
    $.ajax({
      url: `http://localhost:8000/criteriaDetails/${criteriaId}`,
      method: "get",
      datatype: "json",
      success: function (data) {
        console.log(data)
        // $(e).parents("tr").remove();
      }
    })
    // console.log($(this).children("option:selected").val())
  })

})
