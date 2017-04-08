<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <template v-if="dataLoading">
                    Loading...
                </template>

                <template v-else>
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ survey.name }}</div>

                        <div class="panel-body">

                            <div v-for="question in questions" class="question">
                                <p>{{ question.question }}</p>
                                <div class="row">
                                    <div class="col-md-4" v-for="option in question.options">
                                        A: {{ option.option }} {{ option.count }}
                                </div>
                                </div>

                            </div>

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
        dataLoading: false,
        survey: window.survey,
        questions: {},
      }
    },


    created() {
      this.getSurvey();
    },

    methods: {

      getSurvey() {
        this.dataLoading = true;
        let survey_id = this.survey.id;
        axios.get('/api/answers/'+survey_id).then(res => {
            this.questions = res.data;
            this.dataLoading = false;
        })

      }

    }

  }
</script>
