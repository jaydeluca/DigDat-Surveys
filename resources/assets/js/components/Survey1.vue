<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <template v-if="dataLoading">
                    Loading...
                </template>

                <template v-else>
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ survey.name }}</div>

                        <div class="panel-body">

                            <template v-if="submitted">
                                Thanks!
                            </template>

                            <template v-else>
                                <div v-for="question in survey.questions" class="question">
                                    <p>{{ question.question }}</p>
                                    <select v-model="question.answer">
                                        <option value="">Select An Answer</option>
                                        <option v-for="option in question.options">{{ option }}</option>
                                    </select>
                                </div>
                                <button type="button" class="btn" @click="submitSurvey">Submit</button>
                            </template>

                        </div>
                    </div>
                </template>

            </div>
        </div>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        submitted: false,
        dataLoading: false,
        survey_id: 1,
        survey: {},

      }
    },


    created() {
      this.getSurvey();
    },

    methods: {

      getSurvey() {
        this.dataLoading = true;
        let survey_id = this.survey_id;
        axios.get('/api/survey/'+survey_id).then(res => {
            let data = res.data;

            data.questions.forEach(question => {
              question.options = JSON.parse(question.options);
              question.answer = '';
            });
            this.survey = data;
            this.dataLoading = false;
        })

      },

      submitSurvey() {
        let data = this.survey;
        axios.post('api/survey/submit', data).then(res => {
            console.log(res.data);
            this.submitted = true;
        })


      }

    }

  }
</script>
