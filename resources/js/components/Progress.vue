<template>
	<div class="text-center mx-auto">
	<v-progress-circular
	  indeterminate
	  color="teal darken-2"
	  :size="200"
      class="mx-auto"
	></v-progress-circular>
</div>
</template>
<style scoped>
  .v-progress-circular{
  	margin: 1rem;
  	margin-top:170px !important;

  }
/* .v-application .primary--text{
      color: #4caf50 !important;

  } */
 .v-progress-circular__overlay{
     text-align: center !important;
 }
</style>
<script>
export default {

}
