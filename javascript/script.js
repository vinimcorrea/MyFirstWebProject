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
    searchRestaurantCategory.addEventListener('input', async function(){
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
    searchDishRestaurant.addEventListener('input', async function(){
        const response = await fetch ('../api/api_dishes.php?search=' + this.value)
        console.log(this.value)
        const dishes = await response.json()
        console.log(dishes)

        const firstDiv = document.querySelector('.RestaurantCategory')
        firstDiv.innerHTML = ''
    
        for(const dish of dishes){
            const h2 = document.createElement('h2')
            const secondDiv = document.createElement('div')
            const h6 = document.createElement('h6')
            const p = document.createElement('p')
            const img = document.createElement('img')
            const form = document.createElement('form')
            const button = document.createElement('button')

            h6.textContent = dish['Name'] + ' / ' + '€' + dish['Price']
            p.textContent = dish['Ingredients']
            img.src='https://picsum.photos/200?' + dish['DishId']
            h2.textContent = dish['CategoryName']
            button.textContent = 'Purchase'


            form.appendChild(button)
            secondDiv.appendChild(h6)
            secondDiv.appendChild(img)
            secondDiv.appendChild(p)
            secondDiv.appendChild(form)

            firstDiv.appendChild(h2)
            firstDiv.appendChild(secondDiv)
        }
    })
}   