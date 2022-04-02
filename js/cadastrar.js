$(document).ready(() => {
    
    

        const cep = document.querySelector("#cep")

        const mostrarDados = (result) => {
            for(const campo in result){
                if(document.querySelector("#"+campo)){
                    document.querySelector("#"+campo).value = result[campo]
                }
            }
        }

        cep.addEventListener("blur",(e)=>{
            let search = cep.value.replace("-","")

            const options = {
                method: 'GET',
                mode: 'cors',
                cache: 'default'
            }
 
            fetch(`https://viacep.com.br/ws/${search}/json/`,options)
            .then(response =>{ response.json()
            .then(result => mostrarDados(result))
            })
            .catch(e => {if(cep.value){alert('Cep invalido!')}})
            
        })

    $('#button').on('click', e => {
       
        e.preventDefault()

        

        if($('#senha').val() != $('#confirm').val())
        {   
            $('.senha').show();
            $('.confirm').show();
            $('.tamanho').css({'display':'none'})

        }else if($('#senha').val().length < 6){
           
            $('.tamanho').show();

            throw new Error("Senha não correspode ao tamanho exigido!");


        }else{

            $('.senha').css({'display':'none'})
            $('.confirm').css({'display':'none'})
            $('.tamanho').css({'display':'none'})

            let email = $('#email').val()
            let sucesso
            for(let i=0; i < email.length; i++){
                if(email[i] == '@'){    
                    sucesso = email[i]                            
                }
            }
            
            if(!sucesso){    
                $('.email').show();
                    
                throw new Error("Caracter invalido!");          
            }
    
            if($('#idade').val() == ''){
                $('.idade').show();

                throw new Error("Preencha a idade!!");          
            }else
            {
                $('.idade').css({'display':'none'})
            }

            let cep = $('#cep').val().replace("-","")
            
            if ($('#check').is(":checked"))
            {
                verificar = {
                    nome : $('#nome').val(),
                    ultimo: $('#ultimo').val(),
                    email : $('#email').val(),
                    cep : cep,
                    localidade : $('#localidade').val(),
                    uf : $('#uf').val(),
                    senha: $('#senha').val(),        
                    acao: 'cadastrar'   
                }
                
                if(true){

                    $.each(verificar, function( chave, valor) {
        
                        if(valor == ''){
                            
                            $('.check').css({'display':'none'})

                            $('.'+chave).show()

                            
                            throw new Error("Campo vazio!")
                        }
                        else{
                            $('.'+chave).css({'display':'none'})
                        }
                    });
                }
                
                obj = {
                    nome : $('#nome').val() + ' ' + $('#ultimo').val(),
                    email : $('#email').val(),
                    cep : cep,
                    localidade : $('#localidade').val(),
                    uf : $('#uf').val(),
                    senha: $('#senha').val(),
                    idade: $('#idade').val(),
                    acao: 'cadastrar'   
                }
    
                $.ajax({
                    type: 'POST',
                    url: '../Controller/Service.php',
                    data: obj,
                    success: data => {

                        if(data == 1){
                            alert('Cadastro realizado com sucesso!')
                            window.location.href="../index.php"
                        }else
                        {
                            $('.existe').show()
                            // alert('Erro ao cadastrar, tente novamente mais tarde!')
                            throw new Error("Erro ao cadastrar, tente novamente mais tarde!");

                        }
                    },
                    error: e => {console.log('erro ao cadastrar' + e)}
                })
            }else{
                $('.check').show()               
            }
           
        }      

    })
})
