window.addEventListener('DOMContentLoaded', function () {

  //  Create new product section

  $('button').map(function () { $(this).click(function (e) { e.preventDefault() }) })

  // let PricedCriteria = $('.PricedCriteria');
  // let PricelessCriteria = $('.PricelessCriteria');

  // let PricedForm;
  // let Pricelessform;
  let PricedCriteriasIds = [];
  let pricelessCriteriasIds = [];

  const addNormal = (data, type = 'priced') => {
    return `
      <div class="form-group col-sm-2">
        <label>normal:</label>
        <input class="form-control" placeholder="${data.details[0]}" minlength="3" name="${type}Normal[]" type="text" required>
      </div>
    `;
  }

  const addNested = (data, value, type = 'priced') => {
    let inputFields = data.details.map(detail => {
      value ? output = `value="${detail}"` : output = `placeholder="${detail}"`;
      return `<input class="form-control" ${output}  minlength="3" name="${type}Nested[]" type="text" required>`
    }
    );

    return `
      <div class="form-group col-sm-2">
        <label for="nested">nested:</label>
        ${inputFields.join('')}
      </div>
    `;
  }

  const addOption = (data, type = 'priced', multiple = '') => {
    let options = data.details.map(detail => `<option value="${detail}">${detail}</option>`);

    return `
      <div class="form-group col-sm-2">
        <label for="option">Options:</label>
        <select class="form-control" name="${type}Option[]" id="option" ${multiple} required >
          ${options.join('')}
        </select>
      </div>
    `;
  }

  const addColor = (data, type = 'priced', multiple = '') => {
    let colors = data.details.map(detail => `<option value="${detail}">${detail}</option>`);

    return `
      <div class="form-group col-sm-2">
        <label for="color">Color:</label>
        <select class="form-control" name="${type}Color[]" id="color" ${multiple ? 'multiple' : ''} required>
          ${colors.join('')}
        </select>
      </div>
    `;
  }

  const addPrice = () => {
    `
    <div class="form-group col-sm-2">
      <label for="price">Price:</label>
      <input class="form-control" name="price[]" min="1" type="number" id="price" required>
    </div>
    `
  }

  const addAmount = () => {
    `
    <div class="form-group col-sm-2">
      <label for="amount">amount:</label>
      <input class="form-control" name="amount[]" min="1" type="number" id="amount" required>
    </div>
      `
  }

  const deleteRow = () => {
    $('.deleteRow').last().click(function (e) {
      e.preventDefault();
      let ok = confirm('are you sure ?');
      if (ok)
        $(this).parent().remove()
    })
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
          return addOption(item);
          break;
        case 'color':
          return addColor(item);
          break;
      }
    })
    $('#pricedSelectMenu').css('display', 'none');
    $('#PricedContainer').append($(`
    <h3> new item </h3>
    <input class="form-control" style="display:none;" name="pricedCount" min="1" value="1" type="number" id="pricedCount" required>
    <input class="form-control" style="display:none;" name="pricedIds" min="1" value="${PricedCriteriasIds}" type="text" id="pricedCount" required>

    <div class="row newPricedCriteria">
      ${fields.join('')}
      <div class="form-group col-sm-2">
        <label for="price">Price:</label>
        <input class="form-control" name="price[]" min="1" type="number" id="price" required>
      </div>
      <div class="form-group col-sm-2">
        <label for="amount">amount:</label>
        <input class="form-control" name="amount[]" min="1" type="number" id="amount" required>
      </div>
      <button class="btn btn-danger deleteRow" style="margin-top: 24px;"> x </button>
    </div>
    <button class="btn btn-primary" id="newPricedForm"> + </button>`));

    Pricedform = $('.newPricedCriteria').last().clone();
    console.log(Pricedform);
    deleteRow();
    $('#newPricedForm').click(function (e) {
      e.preventDefault();

      $('#pricedCount').val(+$('#pricedCount').val() + 1);
      $('.newPricedCriteria').last().after(Pricedform.clone())

      deleteRow();
    })
  }

  const showPricelessForm = (criterias) => {

    let fields = criterias.map(item => {

      switch (item.type) {
        case 'normal':
          return addNormal(item, 'priceless');
          break;
        case 'nested':
          return addNested(item, false, 'priceless');
          break;
        case 'options':
          return addOption(item, 'priceless', 'multiple');
          break;
        case 'color':
          return addColor(item, 'priceless', 'multiple');
          break;
      }
    })
    $('#PricelessContainer').html($(`

    <h3> new item </h3>
    <div class="row">
      <div class="form-group col-sm-2">
        <label for="price">Price:</label>
        <input class="form-control" name="price[]" min="1" type="number" id="price" required>
      </div>
    </div>
    <div class="row newPricelessCriteria">
      ${fields.join('')}
      <div class="form-group col-sm-2">
        <label for="amount">amount:</label>
        <input class="form-control" name="amount[]" min="1" type="number" id="amount" required>
      </div>
    </div>`));
  }

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

  $('#ShowPricedAddForm').click(() => {
    PricedCriteriasIds.push($('#PricedContainer option:selected').map(function () { return $(this).val() }).get());
    getCriteriasData(PricedCriteriasIds, 'priced');
  })

  $('#ShowPricelessAddForm').click(function () {
    pricelessCriteriasIds.push($('#PricelessContainer option:selected').map(function () { return $(this).val() }).get())
    getCriteriasData(pricelessCriteriasIds, 'priceless');
  })


  // Edit product section

  // console.log(products)
  if (!$.isEmptyObject(products)) {
    console.log(products)
    products.criterias.map(criteria => {
      criteria.pivot.pricedBool ?
        $(`select[name="PricedCriteria_id[]"] option[value=${criteria.pivot.criteria_id}]`).prop("selected", true)
        : $(`select[name="PricelessCriteria_id[]"] option[value=${criteria.pivot.criteria_id}]`).prop("selected", true)
    })

    let pricedArr = JSON.parse(products.priced)

    pricedArr.map((ele, index) => {
      let fields = Object.keys(ele).map(entry => {
        data = pricedArr[index][entry];
        if (typeof (data) == "string")
          data = [data];
        switch (entry) {
          case 'normal':
            return addNormal({ details: [pricedArr[index][entry]] });
            break;
          case 'nested':
            return addNested({ details: data }, value = true);
            break;
          case 'option':
            return addOption({ details: data });
            break;
          case 'color':
            return addColor({ details: data });
            break;
          case 'price':
            return `<div class="form-group col-sm-2">
              <label for="price">Price:</label>
              <input class="form-control" value="${pricedArr[index][entry]}" name="price[]" min="1" type="number" id="price" required>
            </div>`
            break;
          case 'amount':
            return `<div class="form-group col-sm-2">
              <label for="amount">amount:</label>
              <input class="form-control" value="${pricedArr[index][entry]}" name="amount[]" min="1" type="number" id="amount" required>
            </div>`
            break;
        }
      })
      $('#PricedContainer').append($(`
          <br>
          <div class="row newPricedCriteria">
            ${fields.join('')}
            <button class="btn btn-danger deleteRow" style="margin-top: 24px;"> x </button>
          </div>
          `));
    })


    if (products.priceless) {
      let priclessArr = JSON.parse(products.priceless)

      let fields = Object.keys(priclessArr).map((entry) => {
        data = priclessArr[entry];
        if (typeof (data) == "string")
          data = [data];
        switch (entry) {
          case 'normal':
            return addNormal({ details: [priclessArr[entry]] });
            break;
          case 'nested':
            console.log(priclessArr[entry])
            return addNested({ details: data }, true);
            break;
          case 'option':
            return addOption({ details: data });
            break;
          case 'color':
            return addColor({ details: data });
            break;
          case 'price':
            return `<div class="form-group col-sm-2">
              <label for="price">Price:</label>
              <input class="form-control" value="${priclessArr[entry]}" name="price[]" min="1" type="number" id="price" required>
            </div>`
            break;
          case 'amount':
            return `<div class="form-group col-sm-2">
              <label for="amount">amount:</label>
              <input class="form-control" value="${priclessArr[entry]}" name="amount[]" min="1" type="number" id="amount" required>
            </div>`
            break;
        }

      })
      $('#PricelessContainer').append($(`

      <h3> new item </h3>
      <div class="row newPricelessCriteria">
        ${fields.join('')}

      </div>`));

    }
  }

})
