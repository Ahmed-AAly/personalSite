import ClassicEditor from '@ckeditor/ckeditor5-build-classic/build/ckeditor';

let bioEditor = (callback) => {
  if (document.readyState != "loading") callback();
  else document.addEventListener("DOMContentLoaded", callback);
}

// we check if the element is defind, and if it is we init the editor.
$(function () {
  if (document.querySelector('#customTextEditor') != null ) {
    bioEditor(() => { 
        ClassicEditor
            .create(document.querySelector('#customTextEditor'),{
              
            })
            .catch(error => {
                console.log(`error`, error)
            });
    });
  }
})

