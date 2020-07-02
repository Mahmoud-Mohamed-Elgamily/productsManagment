window.addEventListener('DOMContentLoaded', function () {


  let inputItems = document.querySelectorAll('input#type');
  let container = $('#extraContent');
  let multipleData = `<ul>
                      <li id='clone' class="form-options">
                        <input class="form-control" minlength="3" name="details[]" type="text">
                        <button class="btn btn-danger removeItem"> x </button>
                      </li>
                    </ul>
                    <button class="btn btn-primary" id="newRule">+ Add Rule</button>`
  let colorPicker = `<ul>
                       <li id='clone' class="form-options">
                         <input type='text' class='basic' name="details[]" value='blue'/>
                         <button class="btn btn-danger removeItem"> x </button>
                       </li>
                     </ul>
                     <div class="palette" id="colorPalette"></div>
                     <button class="btn btn-primary" id="newColor"> Add Color</button>`
  let cloneItem;

  inputItems.forEach(item => item.addEventListener('change', e => {
    container.css('display', 'block');
    switch (e.target.value) {
      case 'normal':
        container.html($(`
        <input class="form-control" minlength="3" name="details" type="text">
      `))
        break;

      case 'nested':
      case 'options':
        container.html($(multipleData))
        cloneItem = $('#clone')
        addEventToNewRule();
        addEventToRemoveButtons()

        break;
      case 'color':
        container.html($(colorPicker))
        cloneItem = $('#clone')
        $(".basic").spectrum({
          type: "component",
          showPaletteOnly: "true"
        });
        addNewColor();
        addEventToRemoveButtons()
        break;
    }
  }))



  // handle nested option
  function addEventToNewRule() {
    $('#newRule').on('click', (e) => {
      e.preventDefault();
      let clone = cloneItem.clone(true);
      clone.removeAttr('id');
      clone.children('input').val('')
      $('#extraContent ul').append(clone);
    })
  }
  function addEventToRemoveButtons() {
    let removeButtons = $('.removeItem');

    removeButtons.last().on('click', e => {
      e.preventDefault();
      let confirmation = confirm('about to remove this elemet ?')
      if (confirmation)
        e.target.parentElement.remove()
    })
  }
  // handle color option
  function addNewColor() {
    $('#newColor').on('click', (e) => {
      e.preventDefault();
      let clone = cloneItem.clone(true);
      clone.removeAttr('id');
      $('#extraContent ul').append(clone);
      $(".basic").last().spectrum({
        type: "component",
        showPaletteOnly: "true"
      });
    })
  }

})
