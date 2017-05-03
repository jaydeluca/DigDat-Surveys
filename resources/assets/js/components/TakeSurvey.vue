<template>
    <div class="container survey">

        <template v-if="dataLoading">
            <div class="card-content">
                Loading...
            </div>
        </template>

        <template v-else>

            <div class="section">
                <div class="card">
                    <div class="card-content questions">
                        <template v-if="submitted">
                            Thanks!
                        </template>

                        <template v-else>
                            <div v-for="question in survey.questions" class="section question">
                                <p>{{ question.question }}</p>
                                <span class="select">
                                    <select v-model="question.answer">
                                        <option value="">Select An Answer</option>
                                        <option v-for="option in question.options">{{ option }}</option>
                                    </select>
                                </span>
                            </div>
                        </template>

                    </div>
                    <div class="card-footer" v-if="!submitted">
                        <button type="button" class="button is-fullwidth is-primary" @click="submitSurvey">Submit</button>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        submitted: false,
        dataLoading: false,
        survey_id: window.survey.id,
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
        axios.post('/api/survey/submit', data).then(res => {
            this.submitted = true;
        })
      }

    }

  }
</script>
