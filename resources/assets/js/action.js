class Action {
    constructor(){
        this.nome = 'joao'
        $('.deletar').on('click', (e) =>{
            e.preventDefault()
            this.confirmaDelecao(e)
        })
    }
 
    confirmaDelecao(event){
        console.log(event)
        var paciente = $(event.target).closest('.linhaPaciente').find('.nomePaciente').html()
        bootbox.confirm("Você tem certeza que quer " + paciente + " excluir?", (result) => {
            console.log(result)
            if(result == true){
                $(event.target).closest('.deleta').submit()
            }

            bootbox.hideAll()
            return false
        })
    }
}
 
let action = new Action

$(document).ready(function () {
    $('.fa-plus').on('click', function () {
        let endereco = $('.enderecoClone').clone(true)
        endereco.removeClass('hide')
        endereco.removeClass('enderecoClone')
        endereco.addClass('endereco')
        $('#enderecos').append(endereco)
    });
    
    $('.fa-minus-circle').on('click', function () {
        if($('.endereco').length >1 ) $('.endereco').last().remove()
    });
});

setTimeout(function () {
    $('#success').hide('fast')
}, 5000)