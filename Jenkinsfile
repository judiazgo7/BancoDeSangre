pipeline {
    agent any

    stages {
        stage ('docker build') {
            steps {
                script {
                    sh "docker compose up -d"
                }
            }
        }

        stage ('docker push') {
            steps {
                script{
                    sh "docker push judiazgo7/bancodesangre:1.0.${BUILD_ID}"
                }
            }
        }
    }   
}