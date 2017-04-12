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
                                <div class="col-sm-12">
                                    <strong>Referrals:</strong>
                                    <div v-for="(referrer, index) in referrers"
                                         class="referrer"
                                         :class="{ 'alternate-question': isEven(index)}">
                                            <div>{{ referrer.url }}</div>
                                            <div>{{ referrer.pageViews }}</div>
                                    </div>
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
                                        <strong>{{ option.count }} ({{ percentageCalc(option.count, question.total) }}%)</strong>
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

      percentageCalc(value, total) {
        return Math.round((value/total)*100);
      },

      isEven(index) {
        return index%2 === 0;
      },

      getSurvey() {
        this.dataLoading = true;
        let survey_id = this.survey.id;
        axios.get('/api/answers/'+survey_id).then(res => {
            let questions = res.data;
            questions.forEach(item => {
              let total = 0;
              item.options.forEach(item => {
                total += item.count;
              });
              item.total = total;
            });

            this.questions = questions
            this.dataLoading = false;
        })

      }

    }

  }
</script>
