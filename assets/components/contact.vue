



<template>
 <form class="vue-form" @submit.prevent="submit">


	<div id="contact-form" class="contact-form">
		<h1 class="contact-form_title">Contact Form</h1>
		<div class="separator"></div>

		<form class="form" @submit="onSubmit">
			<input required name="name"  placeholder="Name"   v-model="name" type="text" autocomplete="off">
			<input required name="email"  placeholder="E-mail" type="email"  v-model="email" autocomplete="off">
			<textarea name="message"  rows="4"  v-model="message" placeholder="Message"></textarea>
		   <button class="button">Send</button>
		</form>
	</div>
  </form>

</template>

<script>
import axios from 'axios'

export default ({

     data: function() {
     return {
        name: '',
        email: '',
        message: '',


     }},
   methods:{
    		/**
		 * Handler for submit
		 */	
		onSubmit(evt) {
			evt.preventDefault();
            
            
         const data = {
             name: this.name,
             email : this.email,
             message  : this.message
          }   

		 axios.post('http://symfony-tp4.test/contact/store',data).then((repense)=>{
                alert('Merci pour votre message!'+ this.name )
            })
        }
        
        },

       
})
</script>
