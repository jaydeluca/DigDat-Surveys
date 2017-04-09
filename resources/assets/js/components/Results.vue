<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <template v-if="dataLoading">
                    Loading...
                </template>

                <template v-else>
                    <div class="panel panel-default">
                        <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: baseline;">
                            <h3>{{ survey.name }}</h3>
                            <div>
                                <strong>
                                    Submissions: {{ submissions }}
                                </strong>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-10 col-lg-offset-1">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th colspan="2">Top Referrers</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="referrer in referrers">
                                            <td>{{ referrer.url }}</td>
                                            <td>{{ referrer.pageViews }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Questions:</div>

                        <div class="panel-body">

                            <div v-for="(question, index) in questions" class="question" :class="{ 'alternate-question': isEven(index)}">
                                <blockquote>
                                    <p class="question-text">{{ question.question }}</p>
                                </blockquote>
                                <div class="row answers">
                                    <div class="col-md-3 well well-sm answer" v-for="option in question.options">
                                        {{ option.option }}
                                        <strong>{{ option.count }}</strong>
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
        submissions: window.submissions,
        questions: {},
        referrers: window.referrers
      }
    },


    created() {
      this.getSurvey();
    },

    methods: {

      isEven(index) {
        return index%2 === 0;
      },

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
