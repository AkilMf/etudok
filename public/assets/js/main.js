document.addEventListener('DOMContentLoaded', function () {
    /* Sending etudiant_id to delete modal */
    let triggersBtn = document.querySelectorAll('.trigger-btn');

    let form = document.querySelector('.deleteForm');

    for (let i = 0; i < triggersBtn.length; i++) {
        triggersBtn[i].addEventListener('click', function () {
            let idStudent = triggersBtn[i].getAttribute('etudiant-id'),
                formAction = form.getAttribute('action'),
                splitedUrl = formAction.split('/');

            splitedUrl[4] = idStudent;
            let newUrl = splitedUrl.join('/')
            console.log(newUrl)
            form.setAttribute('action', newUrl);
            //console.log(form)
        })
    }


});