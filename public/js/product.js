window.addEventListener('DOMContentLoaded', function () {

  $('button').map(function () { $(this).click(function (e) { e.preventDefault() }) })

  let PricedCriteria = $('.PricedCriteria');
  let PricelessCriteria = $('.PricelessCriteria');

  let PricedForm;
  let Pricelessform;
  let PricedCriteriasIds = [];
  let pricelessCriteriasIds = [];

  const addNormal = (data,type='priced') => {
    return `
      <div class="form-group col-sm-2">
        <label>normal:</label>
        <input class="form-control" placeholder="${data.details[0]}" minlength="3" name="${type}Normal[]" type="text">
      </div>
    `;
  }

  const addNested = (data,type='priced') => {
    let inputFields = data.details.map(detail =>
      `<input class="form-control" placeholder="${detail}" minlength="3" name="${type}Nested[]" type="text">`
    );

    return `
      <div class="form-group col-sm-2">
        <label for="nested">nested:</label>
        ${inputFields.join('')}
      </div>
    `;
  }

  const addOptions = (data,type='priced',multiple='') => {
    let options = data.details.map(detail => `<option value="${detail}">${detail}</option>`);

    return `
      <div class="form-group col-sm-2">
        <label for="option">Options:</label>
        <select class="form-control" name="${type}Option[]" id="option" ${multiple}>
          ${options.join('')}
        </select>
      </div>
    `;
  }

  const addColor = (data,type='priced',multiple='') => {
    let colors = data.details.map(detail => `<option value="${detail}">${detail}</option>`);

    return `
      <div class="form-group col-sm-2">
        <label for="color">Color:</label>
        <select class="form-control" name="${type}Color[]" id="color" ${multiple ? 'multiple' : ''}>
          ${colors.join('')}
        </select>
      </div>
    `;
  }

  const showPricedForm = (criterias) => {

    let fields = criterias.map(item => {

      switch (item.type) {
        case 'normal':
          return addNormal(item);
          break;
        case 'nested':
          return addNested(item);
          break;
        case 'options':
          return addOptions(item);
          break;
        case 'color':
          return addColor(item);
          break;
        default:
          break;
      }
    })
    $('#PricedContainer').html($(`
    <h3> new item </h3>
    <input class="form-control" style="display:none;" name="pricedCount" min="1" value="1" type="number" id="pricedCount">
    <input class="form-control" style="display:none;" name="pricedIds" min="1" value="${PricedCriteriasIds}" type="text" id="pricedCount">

    <div class="row newPricedCriteria">
      ${fields.join('')}
      <div class="form-group col-sm-2">
        <label for="price">Price:</label>
        <input class="form-control" name="price[]" min="1" type="number" id="price">
      </div>
      <div class="form-group col-sm-2">
        <label for="amount">amount:</label>
        <input class="form-control" name="amount[]" min="1" type="number" id="amount">
      </div>
    </div>
    <button class="btn btn-primary" id="newPricedForm"> + </button>`));

    Pricedform = $('.newPricedCriteria').last().clone();
    console.log(Pricedform);

    $('#newPricedForm').click(function (e) {
      console.log($('.newPricedCriteria').last())
      e.preventDefault();
      $('#pricedCount').val(+$('#pricedCount').val()+1);
      $('.newPricedCriteria').last().after(Pricedform.clone())
    })
  }

  const showPricelessForm = (criterias) => {

    let fields = criterias.map(item => {

      switch (item.type) {
        case 'normal':
          return addNormal(item,'priceless');
          break;
        case 'nested':
          return addNested(item,'priceless');
          break;
        case 'options':
          return addOptions(item,'priceless','multiple');
          break;
        case 'color':
          return addColor(item,'priceless','multiple');
          break;
        default:
          break;
      }
    })
    $('#PricelessContainer').html($(`
    <input class="form-control" style="display:none;" name="pricelessIds" min="1" value="${pricelessCriteriasIds}" type="text" id="pricedCount">

    <h3> new item </h3>
    <div class="row">
      <div class="form-group col-sm-2">
        <label for="price">Price:</label>
        <input class="form-control" name="price[]" min="1" type="number" id="price">
      </div>
    </div>
    <div class="row newPricelessCriteria">
      ${fields.join('')}
      <div class="form-group col-sm-2">
        <label for="amount">amount:</label>
        <input class="form-control" name="amount[]" min="1" type="number" id="amount">
      </div>
    </div>`));
  }


  // priced criteria section handlers
  const getCriteriasData = (ids, caller) => {
    $.ajax({
      url: `http://127.0.0.1:8000/criteriaDetails/${ids[0].join(',')}`,
      method: "get",
      datatype: "json",
      success: function (data) {
        console.log(data);
        caller == 'priced' ? showPricedForm(data) : showPricelessForm(data);
      },
      error: (err) => console.log('err', err),
    })
  }

  $('button#newPricedCriteria').click(function () {
    $('.PricedCriteria').last().after(PricedCriteria.clone())
  })

  $('#ShowPricedAddForm').click(() => {
    PricedCriteriasIds.push($('#PricedContainer option:selected').map(function () { return $(this).val() }).get());
    // console.log(PricedCriteriasIds);
    getCriteriasData(PricedCriteriasIds, 'priced');
  })

  // priceless criteria section handlers
  $('button#newPricelessCriteria').click(function () {
    $('.PricelessCriteria').last().after(PricelessCriteria.clone())
  })

  $('#ShowPricelessAddForm').click(function () {
    pricelessCriteriasIds.push($('#PricelessContainer option:selected').map(function () { return $(this).val() }).get())
    // console.log(pricelessCriteriasIds);
    getCriteriasData(pricelessCriteriasIds, 'priceless');
  })
})
