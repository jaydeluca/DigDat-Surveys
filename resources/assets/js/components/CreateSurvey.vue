<template>



    </div>
</template>

<script>

  export default {

    name: 'CreateSurvey',

    data() {
      return {
        submitted: false,
        survey: {},
        question: {},
      }
    },

    methods: {

      createSurvey() {
        let data = this.survey;
        axios.post('/api/survey/submit', data).then(res => {
            this.submitted = true;
        })
      }

    }

  }
</script>
