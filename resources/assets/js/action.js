class Action {
    constructor(){
        $('.deletar').on('click', (e) =>{
            e.preventDefault()
            this.confirmaDelecao()
        })
    
    }
 
    confirmaDelecao(){
        bootbox.confirm("Você tem certeza que quer excluir isso?", function(result){
            $('.deletar').first().closest('.deleta').submit()
        })
        bootbox.prompt(closeButton,false)
    }
}
 
let action = new Action