
const container = document.querySelector('.container');
const form = document.querySelector('form');
const containerPlats = document.querySelector('.container-plats')


// rendre la page html 
const render = () => {
   fetch('http://localhost/framework_api/').then(response => response.json()).then(restaurants => {
      console.log(restaurants);
      const templateRestaurant = restaurants.map(restaurant => displayRestaurant(restaurant));

      restaurants.forEach((restaurant) => {
         if (restaurant.plats.length) {
            const templatePlats = restaurant.plats.map(plat => displayPlat(plat));
            const contentPlats = document.createElement('div');
            contentPlats.append(...templatePlats);
            containerPlats.append(contentPlats);
            console.log(restaurant.plats);
         }
      })

      container.innerHTML = "";
      container.append(...templateRestaurant, containerPlats);
   }).catch(err => console.log(err));
}

// Afficher tous les restaurants
const displayRestaurant = (restaurant) => {
   const contentRestaurant = document.createElement('div');
   contentRestaurant.innerHTML = ` 
      <div class='d-flex flex-column mb-2'>
         <h5 class='fw-bold fs-6 mb-4'> ${restaurant.name} </h5>
         <p>Adresse: ${restaurant.adresse}</p>
         <p>Ville: ${restaurant.city}</p>
         <button class="btn btn-outline-danger btn-sm" id=${restaurant.id} >suprimer</button>
      </div>`;
   const btnDelete = contentRestaurant.querySelector('button');
   btnDelete.addEventListener('click', (e) => {
      e.preventDefault();
      deleteRestaurant(btnDelete.id);
   })
   return contentRestaurant;
}

// Afficher tous les plats
const displayPlat = (plat) => {
   const contentPlat = document.createElement('div');
   contentPlat.className = 'list-comment';
   contentPlat.innerHTML = ` 
      <div class='d-flex flex-column'>
      <h2>Plas</h2>
         <p class='fw-bold'> Nom du plat: ${plat.description} </p>
         <p class="fw-bold"> Prix: ${plat.price}</p>
      </div>
      <hr>`;
   return contentPlat;
}

// Supprimer un restaurant 
const deleteRestaurant = async (id) => {
   try {
      const response = await fetch('http://localhost/framework_api/?action=suppr', {
         method: 'DELETE',
         headers: new Headers({ "Content-Type": "application/json" }),
         body: JSON.stringify({ "id": id })
      });
      console.log(await response.json());
   } catch (err) { console.log(err) }
}

// Poster un restaurant
const postRestaurant = async (restaurant) => {
   try {
      const response = await fetch('http://localhost/framework_api/?action=new', {
         method: 'POST',
         headers: new Headers({ "Content-Type": "application/json" }),
         body: JSON.stringify(restaurant)
      });
      console.log(await response.json());
   } catch (err) { console.log(err) }
}

// soummaitre le formulaire pour poster un restaurant
form.addEventListener('submit', (e) => {
   e.preventDefault();
   postRestaurant({
      name: e.target.name.value,
      adresse: e.target.adresse.value,
      city: e.target.city.value
   });
   form.reset();
});


render();