# Simple Laravel 5 Photo Gallery for AWS EBS
Simple AWS Elastic Beanstalk photo gallery built on top of Laravel 5
### Requirements
- PhP >=5.5.9
- MySQL ~ 5.5
- Composer

### Environment configuration
Gallery photos are stored on AWS S3 bucket. Follow [this](http://docs.aws.amazon.com/AWSSimpleQueueService/latest/SQSGettingStartedGuide/AWSCredentials.html) guide  to get AWS access key id and secret key and put them into **.env** file as `AWS_KEY_ID` and `AWS_SECRET`. Then define your bucket's region and name as `S3_REGION` and `S3_BUCKET`.
If you're going to run the app on your local machine bu sure to edit database properties in **.env** file.
See **.env.example** for more info.

### Initialization and Deployment
To deploy this application an EBS with PhP and MySQL RDS is required. This can be done through AWS console or through `eb init` command. After that execute `eb deploy` command to deploy the application.   
