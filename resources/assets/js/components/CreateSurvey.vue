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

                <!-- Question -->

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
        option: ''
      }
    },

    methods: {

      createSurvey() {
        let data = this.survey;
        axios.post('/api/survey/submit', data).then(res => {
          this.submitted = true;
        })
      },

      saveQuestion() {
        // validation
        if (true) {
          this.survey.questions.push(this.question);
          this.question = {
            question: '',
            options: []
          }
        }
      },

      saveOption(question) {

        // validation
        if (true) {




        }

      }

    }

  }
</script>
