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
        bootbox.confirm("Você tem certeza que quer excluir isso?", (result) => {
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

