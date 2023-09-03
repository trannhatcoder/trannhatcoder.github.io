var imgList = document.querySelectorAll('img')
var container = document.querySelector('.container')
var btnList = document.querySelectorAll('button')

var arr = []
imgList.forEach(item=>{
    arr.push({
        src: item.src,
        type: item.getAttribute('type')
    })
})

btnList.forEach(btn=>{
    btn.addEventListener('click', e=>{
        let type = e.currentTarget.getAttribute('type')
        let filterData = arr.filter(food=>{
            return food.type == type
        })
        render(filterData)
    })
})

function render(list){
    container.innerHTML = ''
    list.forEach(item=>{
        let imgElement = document.createElement('img')
        imgElement.src = item.src
        imgElement.setAttribute('type', item.type)
        container.append(imgElement)
    })
}
