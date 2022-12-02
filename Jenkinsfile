pipeline {
    agent any

    stages {
        stage ('docker stop') {
            steps {
                script {
                    sh "docker compose down"
                }
            }
        }
        stage ('docker build') {
            steps {
                script {
                    sh "docker compose up -d"
                }
            }
        }
        stage ('docker tag') {
            steps {
                script{
                    sh "docker tag miweb-miservidor judiazgo7/bancodesangre:1.0.${BUILD_ID}"
                }
            }
        }
        stage ('docker login') {
            steps {
                script{
                    sh "docker login -u 'judiazgo7' -p 'Juancd1974*' docker.io"
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



