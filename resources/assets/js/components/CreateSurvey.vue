<template>
    <div>

        <div class="columns">
            <div class="column is-8 is-offset-2">

                <div class="box">
                    <div class="field">
                        <label class="label">Name</label>
                        <p class="control">
                            <input class="input" type="text" placeholder="Ex. Patriots Fan Survey"
                                   v-model="survey.name">
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <textarea
                                    class="textarea"
                                    placeholder="Description (optional)"
                                    v-model="survey.description">
                            </textarea>
                        </p>
                    </div>
                </div>

                <span class="title is-4">Questions:</span>
                <div class="box has-text-dark" v-for="question in survey.questions">
                    <strong>{{ question.question }}</strong>
                    <hr>

                    <ul>
                        <li v-for="option in question.options">
                            {{ option }}
                        </li>
                    </ul>
                </div>

                <!-- Question -->
                <survey-question
                        v-for="n in question_count"
                        :data="n"
                        :key="n">
                </survey-question>

            </div>
        </div>

    </div>
</template>

<script>

  export default {

    name: 'CreateSurvey',

    data() {
      return {
        submitted: false,
        survey: {
          name: '',
          description: '',
          questions: []
        },
        question: {
          question: '',
          options: []
        },
        option: '',
        question_count: 1,
      }
    },

    mounted() {
      AppEvents.$on('save-question', this.saveQuestion)
    },

    methods: {

      createSurvey() {
        let data = this.survey;
        axios.post('/api/survey/submit', data).then(res => {
          this.submitted = true;
        })
      },

      saveQuestion(question) {
        // validation
        if (true) {
          this.survey.questions.push(question);
        }
      },

    },

    components: {
      'survey-question': require('./CreateSurveyQuestion.vue')
    }

  }
</script>
