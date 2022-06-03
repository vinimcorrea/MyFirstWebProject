const searchRestaurantName = document.querySelector('#search-restaurants')
//const searchRestaurantName = document.querySelector('#search_restaurant_by_name')
const searchRestaurantCategory = document.querySelector('#search-restaurant-by-category')
const searchRestaurantCategorybtn = document.querySelector('#btn-category')


const searchDishRestaurant = document.querySelector('#search-dishes')

if(searchRestaurantName){
    searchRestaurantName.addEventListener('input', async function(){
    const response = await fetch ('../api/api_restaurants.php?search=' + this.value + '&mode=name'  )
    console.log(this.value)
    const restaurants = await response.json()

    const section = document.querySelector('#restaurants')
    section.innerHTML = ''

    for(const restaurant of restaurants){
        const div = document.createElement('div')
        div.className = 'rest_items'
        const span = document.createElement('span')
        span.className = 'caption'
        const img = document.createElement('img')
   

        const spanDiv = document.createElement('div')
        const spanA = document.createElement('a')
        spanA.href = "/../pages/restaurant.php?id=" + restaurant['RestaurantId']
        const spanP = document.createElement('p')

        spanDiv.className = 'rest_review'


        spanDiv.textContent = restaurant['Review']


        img.src = 'https://picsum.photos/200?' + restaurant['RestaurantId']
        spanP.textContent = restaurant['name']
        spanA.textContent = restaurant['RestaurantName']
        
        span.appendChild(spanA)
        span.appendChild(spanDiv)
        span.appendChild(spanP)

        div.appendChild(img)
        div.appendChild(span)

        section.appendChild(div)

    }

    })
}

if(searchRestaurantCategory){
    searchRestaurantCategory.addEventListener('click', async function(){
        const response = await fetch ('../api/api_restaurants.php?search=' + this.value + '&mode=category')
        const restaurants = await response.json()
        console.log(this.value)

        const section = document.querySelector('#restaurants')
        section.innerHTML = ''

        for(const restaurant of restaurants){
            const div = document.createElement('div')
            div.className = 'rest_items'
            const span = document.createElement('span')
            span.className = 'caption'
            const img = document.createElement('img')
   

            const spanDiv = document.createElement('div')
            const spanA = document.createElement('a')
            spanA.href = "/../pages/restaurant.php?id=" + restaurant['RestaurantId']
            const spanP = document.createElement('p')

            spanDiv.className = 'rest_review'


            spanDiv.textContent = restaurant['Review']


            img.src = 'https://picsum.photos/200?' + restaurant['RestaurantId']
            spanP.textContent = restaurant['name']
            spanA.textContent = restaurant['RestaurantName']
            
            span.appendChild(spanA)
            span.appendChild(spanDiv)
            span.appendChild(spanP)

            div.appendChild(img)
            div.appendChild(span)

            section.appendChild(div)
        }
    })
}

if(searchDishRestaurant){
    searchRestaurantName.addEventListener('input', async function(){
        const response = await fetch ('../api/api_dishes.php?search=' + this.value)
        const dishes = await response.json()

        const section = document.querySelector('#restaurants')
        section.innerHTML = ''
    
    
    })
}   