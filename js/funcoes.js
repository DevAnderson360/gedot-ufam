class Button {

    constructor(selectorButton)
    {
        //element
        this.button = $(selectorButton);

        this.buttonContentDefault = this.button.html();

        this.buttonControler = false;
        
        this.setElement();
        
    }

    click(method)
    {
        this.button.click(method);
    }

    setElement()
    {
        this.setButtonElement();
        
        if(this.buttonControler == false)
            this.buttonControler = true
        else
            this.buttonControler = false
    }

    disabledAllButtons(prop = true)
    {
        $('button').prop('disabled', prop)
    }

    setButtonElement()
    {
        let buttonContent = null;

        //permuta o button
        if (this.buttonControler){

            this.disabledAllButtons();
            this.button.addClass('btn-warning');
            buttonContent = '<i class="mdi mdi-spin mdi-loading mdi-18px"></i> Carregando...';
        }
        else{
            this.disabledAllButtons(false);
            this.button.removeClass('btn-warning');
            buttonContent = this.buttonContentDefault;
        }

        //renderiza o button
        this.button.html(buttonContent);
    }

}//end class

//button de submite está ligado ao form
class FormValidate {

    constructor(selectorForm, buttonSubmit, buttonReset)
    {

        this.form = $(selectorForm);

        this.buttonSubmit = buttonSubmit;

        this.buttonReset  = buttonReset;
        
        this.main();

    }

    main()
    {
        this.preventForm();
        this.setEventInputs();
        this.setButtonSubmit();
        if (this.buttonReset != null) this.setButtonReset();
    }

    preventForm()
    {
        this.form.submit((e) => {
            e.preventDefault()
            this.sendForm();
        });

    }

    redirect(pg){
        window.location.replace(pg);
    }

    setButtonReset()
    {

        const limpar = () => {
            $(this.form).find(':input').each((i,e) =>{
                $(e).val("").removeClass('is-invalid').removeClass('is-valid');
            })
        }

        this.buttonReset.click(() =>{
            limpar();
        });

    }

    setButtonSubmit()
    {
        this.buttonSubmit.click(()=>{
            this.sendForm();
        });
    }

    addInputInvalid()
    {
        this.formInputsInvalidsControl += 1; 
    }

    //seta evento no form
    setEventInputs()
    {
        $(this.form).find(':input[required]').each((i,e) =>{
            $(e).change(()=>{
                this.isEmpyt($(e))
            });
        })
    }

    sendForm()
    {
        this.formInputsInvalidsControl = 0;

        this.inputsValidate();

        if( this.formInputsInvalidsControl == 0 )
        {
            return this.sendPost();
        }

        alert('Verifique os campos em vermelho!')
        
    }

    /*
    *   Methodo para envio do form
    */
    sendPost()
    {
        const URL  = this.form.prop('action');

        const DATA = this.form.serialize();


        $.ajax({
                url: URL,
                type: 'POST',
                data: DATA,
                dataType: 'json',
                beforeSend: () =>  this.buttonSubmit.setElement() ,
                complete: () =>  this.buttonSubmit.setElement(),
                success: (d) => this.successMethod(d),
                error: (r) =>  {
                	console.log(r)
                	alert(`Erro ao processar: ${r.status}\nMensagem do servidor: ${r.responseJSON.msg}`)
                } ,
            });

    }

    successMethod(data)
    {
        alert(data.msg);
        if(data.data != undefined)
            this.redirect(data.data)
        else
            location.reload()
    }

    inputsValidate()//busca todas as inputs do form com required
    {
        $(this.form).find(':input[required]').each((i,e) =>{
            if(this.isEmpyt(e) || $(e).hasClass('is-invalid'))
                this.addInputInvalid();
        })
    }

    isEmpyt(input)
    {//verifica se a string é vazia na imput
        
        if($(input).val() == ""){
            this.addInvalid(input)
            return true;
        }
        else{
            this.addValid(input)
            return false;
        }
    }

    setAction(action)
    {
        this.form.prop('action',action)
    }


    addInvalid(input)
    {
        $(input).addClass('is-invalid').removeClass('is-valid');
    }

    addValid(input)
    {
        $(input).addClass('is-valid').removeClass('is-invalid');
    }

    disabled()
    {
       this.form.find(':input').prop('disabled', true)
    }

    enabled()
    {
       this.form.find(':input').prop('disabled', false)
    }

}//end class

function validarCPF(cpf) {  
    cpf = cpf.replace(/[^\d]+/g,'');    
    if(cpf == '') return false; 
    // Elimina CPFs invalidos conhecidos    
    if (cpf.length != 11 || 
        cpf == "00000000000" || 
        cpf == "11111111111" || 
        cpf == "22222222222" || 
        cpf == "33333333333" || 
        cpf == "44444444444" || 
        cpf == "55555555555" || 
        cpf == "66666666666" || 
        cpf == "77777777777" || 
        cpf == "88888888888" || 
        cpf == "99999999999")
            return false;       
    // Valida 1o digito 
    add = 0;    
    for (i=0; i < 9; i ++)      
        add += parseInt(cpf.charAt(i)) * (10 - i);  
        rev = 11 - (add % 11);  
        if (rev == 10 || rev == 11)     
            rev = 0;    
        if (rev != parseInt(cpf.charAt(9)))     
            return false;       
    // Valida 2o digito 
    add = 0;    
    for (i = 0; i < 10; i ++)       
        add += parseInt(cpf.charAt(i)) * (11 - i);  
    rev = 11 - (add % 11);  
    if (rev == 10 || rev == 11) 
        rev = 0;    
    if (rev != parseInt(cpf.charAt(10)))
        return false;       
    return true;   
}



