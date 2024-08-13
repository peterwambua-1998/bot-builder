// submit btn
const submit_btn = document.getElementById('submit-btn-welcome-msg')
const welcome_msg_input = document.getElementById('welcome-msg-input')
const options_checkbox = document.getElementById('add_options');
const add_btn = document.getElementById('add_button');
const welcome_workflow_form = document.getElementById('welcome-workflow-form');

function validateInput() {
    submit_btn.addEventListener('click', (e) => {
        e.preventDefault();
        
        const error_span = document.querySelector('.welcome-msg-input-error');
    
        if (!welcome_msg_input.value.trim()) {
            error_span.textContent = 'field required'
            return;
        } else {
            error_span.textContent = ''
        }
    
        if (options_checkbox.value) {
            let a = false;
            let b = false;
            let c = false;
            let error_span = document.querySelectorAll('.type-option');
            let display_value = document.querySelectorAll('.display_value');
            let button_action = document.querySelectorAll('.button-action');
            let validate_action = true;
            
            error_span.forEach(element => {
                let v = element.value;
                if (v == 0) {
                    element.nextElementSibling.textContent = 'field required'
                    a = true;
                } else {
                    element.nextElementSibling.textContent = ''
                    a = false;
                }

                if (v == 1) {
                    validate_action == false;
                }

            });


            display_value.forEach((element) => {
                let v = element.value.trim();

                if (!v) {
                    element.nextElementSibling.textContent = 'field required'
                    b = true;
                } else {
                    element.nextElementSibling.textContent = ''
                    b = false;
                }
            })

            if (validate_action) {
                button_action.forEach((element) => {
                    let v = element.value.trim();
    
                    if (!v) {
                        element.nextElementSibling.textContent = 'field required'
                        c = true;
                    } else {
                        element.nextElementSibling.textContent = ''
                        c = false;
                    }
                })
            }

            

            console.log(b);


            if (a == true || b == true || c == true) {
                return;
            }
            
        }
        console.log('save');
        
        // welcome_workflow_form.submit();
    })
}


options_checkbox.addEventListener('click', removeActionInput);

function removeActionInput()  {
    let error_span = document.querySelectorAll('.type-option');
    error_span.forEach(element => {
        
        element.addEventListener('change', (ev) => {
            let v = element.value;
            console.log(v);
            
            if (v == 1) {
                
                element.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.remove();
            }
        })

    });
}




validateInput();
