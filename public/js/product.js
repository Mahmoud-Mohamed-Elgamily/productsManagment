window.addEventListener('DOMContentLoaded', function () {

  $('button').map(function () { $(this).click(function (e) { e.preventDefault() }) })

  let PricedCriteria = $('.PricedCriteria');
  let PricelessCriteria = $('.PricelessCriteria');

  let PricedCriteriasIds = [];
  let pricelessCriteriasIds = [];
  // container.css('display', 'block');


  // priced criteria section handlers
  $('button#newPricedCriteria').click(function () {
    $('.PricedCriteria').last().after(PricedCriteria.clone())
  })

  $('#ShowPricedAddForm').click(() => {
    PricedCriteriasIds.push($('#PricedContainer option:selected').map(function () { return $(this).val() }).get());
    console.log(PricedCriteriasIds);
  })

  // priceless criteria section handlers
  $('button#newPricelessCriteria').click(function () {
    $('.PricelessCriteria').last().after(PricelessCriteria.clone())
  })

  $('#ShowPricedAddForm').click(function () {
    pricelessCriteriasIds.push($('#PricedContainer option:selected').map(function () { return $(this).val() }).get())
  })

  $("#criteria_id").on('change', function () {
    let criteriaId = $(this).children("option:selected").val();
    $.ajax({
      url: `http://localhost:8000/criteriaDetails/${criteriaId}`,
      method: "get",
      datatype: "json",
      success: function (data) {
        console.log(data);
        showField(data);
      },
      error: (err) => console.log(err),
    })
  })

  const showField = (data) => {
    switch (data.type) {
      case 'normal':

        break;
      case 'nested':

        break;
      case 'options':

        break;
      case 'color':

        break;
      default:
        break;
    }
  }

})
