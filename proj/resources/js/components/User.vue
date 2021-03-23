<template>
  <h1>

    {{id}}: <br>Name: {{name}} <br> Ings: {{ingredients}} <br> Visible: {{visible}}


  </h1>

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
        },
        props: {
          id: String,
          name: String,
          ingredients: String,
          visible: Boolean,
        }
    }
</script>
