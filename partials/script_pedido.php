<script>

function edit(id){

    let produto = document.getElementById(`produto${id}`).innerText
    let quantidade = document.getElementById(`quantidade${id}`).innerText
    let troca = document.getElementById(`troca${id}`).innerText
    let valor = document.getElementById(`valor${id}`).innerText
    let valor_unitario = document.getElementById(`valor-unitario${id}`).innerText
    let vendedor = document.getElementById('vendedor').innerText
    let data_entrega = document.getElementById('data-entrega').innerText

    document.querySelector('.chave-key').innerHTML = id
    document.querySelector('.produto').innerHTML = produto
    document.querySelector('.quantidade').value = quantidade
    document.querySelector('.troca').value = troca
    document.querySelector('.valor').innerHTML = valor
    document.querySelector('.valor-unitario').innerHTML = valor_unitario
    document.querySelector('.vendedor').value = vendedor

}

function calcOrders(){

    let quantidade = document.querySelector('.quantidade').value
    let trocas = document.querySelector('.troca').value
    let valor = document.querySelector('.valor').innerHTML
    let valor_unitario = document.querySelector('.valor-unitario').innerHTML
    let valor_total = document.querySelector('.valor-total').innerHTML
    let vendedor = document.querySelector('.vendedor').value
    
    let chave_key = document.querySelector('.chave-key').innerHTML

    if(quantidade === ''){ quantidade = 0 }

    if(trocas === ''){ trocas = 0 }
    
    let quantidade_cobrado = (parseInt(quantidade) - parseInt(trocas)) // quantidade a ser cobrado

    let resultado = parseInt(quantidade_cobrado) * parseFloat(valor_unitario)

    let total = (parseFloat(valor_total) - parseFloat(valor)) + parseFloat(resultado)

    document.querySelector('.valor').innerHTML = resultado.toFixed(2) 

    document.getElementById(`quantidade${chave_key}`).innerHTML = quantidade
    document.getElementById(`troca${chave_key}`).innerText = trocas
    document.getElementById(`valor${chave_key}`).innerText = resultado.toFixed(2)
    document.getElementById('valor-total').innerHTML = total.toFixed(2)
    document.querySelector('.valor-total').innerHTML = total.toFixed(2)
}

document.querySelector('.vendedor').addEventListener('input', () => {
    let vendedor = document.querySelector('.vendedor').value 
    document.getElementById('vendedor').innerText = vendedor
})

document.querySelector('.data-entrega').addEventListener('change', () => {
    let d = document.querySelector('.data-entrega').value
    let date = `${d[8]}${d[9]}/${d[5]}${d[6]}/${d[0]}${d[1]}${d[2]}${d[3]}`
    document.getElementById('data-entrega').innerHTML = date
})

function confirm(changeItens){

    document.getElementById('updateItens').style.display = 'none'
    document.getElementById('closeUpdateItens').style.display = 'none'
    document.querySelector('.spinnerUpdateItens').classList.remove('d-none')

    let quantidade = [];
    let valor = [];
    let troca = [];
    let total = document.getElementById('valor-total').innerHTML
    let vendedor = document.querySelector('.vendedor').value
    let data_entrega = document.querySelector('.data-entrega').value

    document.querySelectorAll('.quantidade-item').forEach(item => {
        quantidade.push(item.innerText)
    })
    document.querySelectorAll('.troca-item').forEach(item => {
        troca.push(item.innerText)
    })
    document.querySelectorAll('.valor-item').forEach(item => {
        valor.push(item.innerText)
    })
    
    changeItens(quantidade, troca, valor, data_entrega, vendedor, total)
}

async function changeItens(quantidade, trocas, valor, data_entrega, vendedor, total){

    const req = await fetch("<?=$base;?>/update.php?id=<?=$id;?>",{
        method: 'POST',
        body: JSON.stringify({
            quantidade: quantidade,
            trocas, trocas,
            valor: valor,
            data_entrega: data_entrega,
            vendedor:  vendedor,
            total: total
        })
    })
    window.location.href="<?=$base;?>/pedido.php?id=<?=$id;?>"
}

function deleteAlert(id){
    document.querySelector('.id-delete').innerHTML = id
}

function notDelete(){
    document.querySelector('.id-delete').innerHTML = ''
}

function deleteItem(deleteItemAction){

    document.getElementById('deleteItens').style.display = 'none'
    document.getElementById('closeDeleteItens').style.display = 'none'
    document.querySelector('.spinnerDeleteItens').classList.remove('d-none')

    let produto = [];
    let quantidade = [];
    let trocas = [];
    let valor = [];
    let valor_unitario = [];

    // PEGA  INDEX DO ARRAY ADICIONADO NO HTML QUANDO O MODAL E ABERTO COM A LINHA SELECIONADA
    let chave_key = document.querySelector('.id-delete').innerHTML

    let valorTotal = document.getElementById('valor-total').innerText
    let valorDosItens = document.getElementById(`valor${chave_key}`).innerText

    //SUBTRAI O VALOR DO ITEM COM INDEX SELECIONDO DO VALOR TOTAL DO PEDIDO
    let total = parseFloat(valorTotal) - parseFloat(valorDosItens)
    // INSERE NO HTML O NOVO VALOR TOTAL DO PEDIDO
    document.getElementById('valor-total').innerHTML = total.toFixed(2)

    // ADICIONA DISPLAY NONE A TODAS AS LINHAS COM O INDEX DO ARRAY SELECIONADO
    document.querySelectorAll(`.line${chave_key}`).forEach(line => {
        line.classList.add('d-none')
    })

    // CRIA UM NOVO ARRAY DE PRODUTO MENOS O QUE TIVER INDEX SELECIONADO
    document.querySelectorAll('.produto-item').forEach(item => {
        if(item.id !== `produto${chave_key}`){
            produto.push(item.innerText)
        }
    })

    // CRIA UM NOVO ARRAY DE QUANTIDADE MENOS O QUE TIVER INDEX SELECIONADO
    document.querySelectorAll('.quantidade-item').forEach(item => {
        if(item.id !== `quantidade${chave_key}`){
            quantidade.push(item.innerText)
        }
    })

    // CRIA UM NOVO ARRAY DE TROCAS MENOS O QUE TIVER INDEX SELECIONADO
    document.querySelectorAll('.troca-item').forEach(item => {
        if(item.id !== `troca${chave_key}`){
            trocas.push(item.innerText)
        }
    })

    // CRIA UM NOVO ARRAY DE VALOR MENOS O QUE TIVER INDEX SELECIONADO
    document.querySelectorAll('.valor-item').forEach(item => {
        if(item.id !== `valor${chave_key}`){
            valor.push(item.innerText)
        }
    })

    // CRIA UM NOVO ARRAY DE PRECO UNITARIO MENOS O QUE TIVER INDEX SELECIONADO
    document.querySelectorAll('.valorUnitario-item').forEach(item => {
        if(item.id !== `valor-unitario${chave_key}`){
            valor_unitario.push(item.innerText)
        }
    })
    
    deleteItemAction(produto, quantidade, trocas, valor, valor_unitario, total)
}

async function deleteItemAction(produto, quantidade, trocas, valor, valor_unitario, total){

    const req = await fetch("<?=$base;?>/deleteItem.php?id=<?=$id;?>",{
        method: 'POST',
        body: JSON.stringify({
            produto: produto,
            quantidade: quantidade,
            trocas, trocas,
            valor: valor,
            valor_unitario: valor_unitario,
            total: total
        })
    })
    window.location.href="<?=$base;?>/pedido.php?id=<?=$id;?>"
}

async function updateStatus(){

    document.getElementById('updateStatusTrue').style.display = 'none'
    document.getElementById('closeUpdateStatusTrue').style.display = 'none'
    document.querySelector('.spinnerStatusTrue').classList.remove('d-none')

    const req = await fetch("<?=$base;?>/changeStatus.php?id=<?=$id;?>",{
        method: 'POST',
        body: JSON.stringify({
            separado: true,
        })
    })
    window.location.href="<?=$base;?>/pedido.php?id=<?=$id;?>"
}

// FUNCAO PARA ALTERAR STATUS POR ITEM PROXIMA VERSAO
// function changeStatus(updateStatus){
//     let chave_key = document.querySelector('.chave-key').innerHTML

//     // ALTERA O BACKGROUND DE TODAS AS LINHAS COM O INDEX DO ARRAY SELECIONADO
//     document.querySelectorAll(`.line${chave_key}`).forEach(line => {
//         line.classList.add('bg-secondary')
//     })
//     updateStatus()
// }

</script>
