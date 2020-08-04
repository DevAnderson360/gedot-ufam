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

/*
*   busca uma informação com ajax
*   @Param URL da requisição e function backand
*/
let getData = (URL,METHOD,DATA = null) =>{
        $.ajax({
        url: URL,
        type: 'POST',
        data: DATA,
        dataType: 'json',
        //beforeSend: () =>  this.buttonSubmit.setElement() ,
        //complete: () =>  this.buttonSubmit.setElement(),
        success: (d) => METHOD(d),
        //error: (r) => alert(`Erro ao processar: ${r.status}\nMensagem do servidor: ${r.responseJSON.msg}`)
    });
}

let janela = (URL) => window.open(URL,"janela1","width=1000, height=650,left="+(window.innerWidth-1000)/2+",top="+(window.innerLeft-800)/2+", directories=no, location=no, menubar=no, scrollbars=no, status=no, toolbar=no, resizable=no");
