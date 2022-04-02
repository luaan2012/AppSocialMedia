$(document).ready(() => {

    $('#recuperar').on('click', e => {
               
        e.preventDefault()
        
        let email = $('#email').val()
        let sucesso
        for(let i=0; i < email.length; i++){
            if(email[i] == '@'){    
                sucesso = email[i]                            
            }
        }
        if(!sucesso){    
            $('.existe').css({'display':'none'})
            $('.email').show();
                
            throw new Error("Caracter invalido!");          
        }
        $('.center').css({'display':'block'})
        $('.email').css({'display':'none'})
        
        $.ajax({
            type: 'POST',
            url: '../Controller/Service.php',
            data: 'acao=recuperar&email='+email,
            success: data => {
                let verificar = JSON.parse(data)
                if(!verificar){           
                    console.log(data)
                    $('.center').css({'display':'none'})
                    $('.existe').show()
                    throw new Error("Erro ao cadastrar, email nao existe!");                  
                }else{

                    $('.existe').css({'display':'none'})
                    $.get('../View/verificar_codigo.php', data => {
                        $('#conteudo').html(data)
                        $('#armazena').val(verificar.id_usuarios)
                        $('body').css({'background-color':'#14171a'})
                    })

                }
            },
            error: e => {console.log('erro ao recuperar' + e)}
        })

        
                               
    })

    $('#verificar').on('click', e => {
        let id = $('#armazena').val()
        $('.centercodigo').css({'display':'block'})
        let code = $('#code').val()
        $.ajax({
            type: 'GET',
            url: '../Controller/Service.php',
            data: `acao=verificar&id=${id}&code=${code}`,
            success: data => {
                let status = JSON.parse(data)
                if(status == "aceito"){
                    $('.codigo').css({'display':'none'})
                    setTimeout(() => {
                        $.get('../View/recuperar_senha_next.php', data => {
                            $('#conteudo').html(data)
                            $('#recuperasenha').val(id)
                        })
                    }, 2000)
                    
                }else{
                    $('.codigo').show()
                }           
            },
            error: e => {console.log('erro ao cadastrar' + e)}
        })
    })

    $('#recuperarnovasenha').on('click', e => {

        
        if($('#novasenha').val() != $('#confirmnova').val()){   
           
            $('.senha').show();
            $('.confirm').show();
            $('.tamanho').css({'display':'none'})

        }else if($('#novasenha').val().length < 6){
           
            $('.tamanho').show();

            throw new Error("Senha não correspode ao tamanho exigido!");


        }else{

            $('.centercodigo').css({'display':'block'})

            let id = $('#recuperasenha').val()
            $('.recuperasenha').css({'display':'block'})

            let senha = $('#novasenha').val()

            $('.senha').css({'display':'none'})
            $('.confirm').css({'display':'none'})
            $('.tamanho').css({'display':'none'})

            $.ajax({
                type: 'POST',
                url: '../Controller/Service.php',
                data: `acao=mudarsenha&id=${id}&senha=${senha}`,
                success: data => {
                    let status = JSON.parse(data)               
                    if(status == "sucesso"){         
                        setTimeout(() => {
                            $('.recuperasenha').css({'display':'none'})
                            setTimeout(() => {
                                alert('Sucesso! senha trocada com sucesso!')
                                window.location.href="../index.php"
                            }, 30)
                            
                        }, 2000)
                        
                    }else{
                        alert('erro ao cadastrar')
                    }           
                },
                error: e => {console.log('erro ao cadastrar' + e)}
            })
        }
    })

})

