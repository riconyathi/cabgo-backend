# Flutter Android Setup

---

- [Introduction](#section-1)
- [Setup Instructions](#section-2)
- [Change Base Url](#section-3)
- [Change the MQTT_URL](#section-4)

<a name="section-1"></a>
## Introduction
In this article, we are going to set up the TYT App’s initial setup for real-time use cases. 

<a name="section-2"></a>
## Setup Instructions

* flutter version for this project is 'Channel stable, 2.10.2'

* Open your project File the Visual Studio Code which is used to create the project and also it is very powerful.

* and in terminal run  command 'flutter pub get'

* project structure is given in image below

![image](../../images/flutter-doc/project-folder-structure.png)


### Major things to do:
<a name="section-3"></a>
1. Change the BASE_URL Variable Presented in the Constants File. 

    * It just updates your server’s primary URL to access all types of API Services From the App to your Server.

    * like this  

        *  <strong> Note : File Location : project/lib/functions/functions.dart </strong>

```flutter
 String url = 'your base url here';

```
<a name="section-4"></a>
2. Change the MQTT_URL value of the Variable which is presented in the SocketHelper File which is presented in the Utils Package.

* It is used to make a Socket Connection between APP and the Server. So Update this value very carefully with your server’s right IP Address.

    * like this 

        * <strong> Note : File Location : project/lib/functions/functions.dart </strong>

```flutter
String mqttUrl = 'your mqtt url here';
int mqttPort = 1883; // port number
```
3. change website url in given files,
	
	* <strong> Note : File Location project/lib/pages/login/login.dart</strong>

```flutter
onTap: () {

openBrowser(

'your terms and condition url here');

},

child: Text(

languages[choosenLanguage]['text_terms'],

style: GoogleFonts.roboto(

fontSize: media.width * sixteen,

color: buttonColor),

 

),
```

* <strong> Note : File Location "project/lib/pages/login/login.dart" </strong>

```flutter
onTap: () {

openBrowser(

'your privacy policy url here');

},

child: Text(

languages[choosenLanguage]['text_privacy'],

style: GoogleFonts.roboto(

fontSize: media.width * sixteen,

color: buttonColor),

),

```	

* <strong> Note : File Location "project/lib/pages/navigatorPages/about.dart" </strong>

```flutter
onTap: () {

openBrowser(

'your terms and conditions url here');

},

child: Text(

languages[choosenLanguage]

['text_termsandconditions'],

style: GoogleFonts.roboto(

fontSize: media.width * sixteen,

fontWeight: FontWeight.w600,

color: textColor),

 

),
```
* <strong> Note : File Location "project/lib/pages/navigatorPages/about.dart" </strong>

```flutter
onTap: () {

openBrowser(

'your privacy policy url here');

},

child: Text(

languages[choosenLanguage]['text_privacy'],

style: GoogleFonts.roboto(

fontSize: media.width * sixteen,

fontWeight: FontWeight.w600,

color: textColor),),
```
* <strong> Note : File Location "project/lib/pages/navigatorPages/about.dart" </strong>


```flutter
onTap: () {

openBrowser('your website main page url here');

},

child: Text(

languages[choosenLanguage]['text_about'],

style: GoogleFonts.roboto(

fontSize: media.width * sixteen,

fontWeight: FontWeight.w600,

color: textColor),

),
```

3. Create & configure account for map using Google map & Cloud by following below documents.

	* Google Cloud console link: https://developers.google.com/maps/documentation/android-sdk/cloud-setup

	* firebase setup doc: https://firebase.google.com/docs/android/setup


4. After created & enabled the billing from google cloud & map console

	* add map api key change the map keys in given locations


* <strong> Note : File Location "project/android/app/src/main/AndroidManifest.xml" </strong>

```flutter
<meta-data android:name="com.google.android.geo.API_KEY"

android:value="your maps api key here"/>

```

* <strong> Note : File Location "project/lib/functions/functions.dart" </strong>

```flutter
String mapkey = 'your map key here';

```

* We need to create nodes in firebase realtime database, please find the sample json database below or refer firebase setup.


* [Sample-json](https://tagxi-server.ondemandappz.com/firebase-database.json)

* <strong> call_FB_OTP </strong> node is used to configure whether the firebase otp should used or dummy otp should use for our testing purpose

5. replace translations at given file if you need,

* <strong> Note : File Location "project/lib/translation/translation.dart" </strong>

```flutter
Map<String, dynamic> languages = {

"en": {

```

6. Download & Paste the google-services.json into the 'project/android/app' folder properly to make proper communication from your App which is a client to FireBase.

![image](../../images/flutter-doc/firebase-setup.png)


7. copy the package name from firebase and paste it in the following files

* <strong> Note : File Location "project/andrroid/app/src/main/AndroidManifest.xml" </strong>


```flutter
<manifest xmlns:android="http://schemas.android.com/apk/res/android"

package="package name here">
```
* <strong> Note : File Location "project/android/app/src/profile/AndroidManifest.xml" </strong>

```flutter
	
<manifest xmlns:android="http://schemas.android.com/apk/res/android"

package="package name here">

```

* <strong> Note : File Location "project/android/app/src/debug/AndroidManifest.xml" </strong>

```flutter
<manifest xmlns:android="http://schemas.android.com/apk/res/android"

package="package name here">
```
* <strong> Note : File Location "project/android/app/build.gradle" </strong>

```flutter
applicationId "package name here"

```

* <strong> Note : File Location "project/android/app/src/main/kotlin/../../../MainActivity.kt" </strong>

	* add package name here

8. change folder name

 if your package name is com.package.android then,

        project/android/app/src/main/kotlin/com/something/something/ to project/android/app/src/main/kotlin/com/package/android

9. replace icons images in following folders in given name 
	
	* project/assets/images/ - logo.png

	* project/android/app/src/main/res/mipmap-hdpi - ic_launcher.png (72x72)

	* project/android/app/src/main/res/mipmap-mdpi - ic_launcher.png (48x48)

	* project/android/app/src/main/res/mipmap-xhdpi - ic_launcher.png (96x96)

	* project/android/app/src/main/res/mipmap-xxhdpi - ic_launcher.png (144x144)

	* project/android/app/src/main/res/mipmap-xxxhdpi - ic_launcher.png (192x192)


10. change app display name in file,

* <strong> Note : File Location "project/android/app/src/main/AndroidManifest.xml" </strong>

```flutter
android:label="project name"

         project/lib/main.dart

 

 title: 'project name',

 ```

11. change payment gateway keys,

* <strong> Note : File Location "project/lib/pages/NavigatorPages/selectwallet.dart" </strong>

```flutter
 Stripe.publishableKey = "your stripe key here"
 ```

* <strong> Note : File Location "project/lib/pages/NavigatorPages/cashfreepage.dart" </strong>

```flutter
'appId':'your cashfree id here',

'stage' : 'TEST or PROD here',

'color1' : 'theme color 1',

'color2' : 'theme color 2',
```

* <strong> Note : File Location "project/pages/NavigatorPages/flutterwavepayment.dart" </strong>
	
	* edit following details as per your need

```flutter
final style = FlutterwaveStyle(

 

appBarText: "app bar text here",

buttonColor: color of button,

appBarIcon:const Icon(Icons.message, color: Color(0xffd0ebff)),

buttonTextStyle:const TextStyle(

color: Colors.black,

fontWeight: FontWeight.bold,

fontSize: 16,

),

appBarColor:const Color(0xffd0ebff),

dialogCancelTextStyle:const TextStyle(

color: Colors.redAccent,

fontSize: 16,

),

dialogContinueTextStyle:const TextStyle(

color: Colors.blue,

fontSize: 16,

),

 

);

 

final Customer customer = Customer(

name: userDetails['name'],

phoneNumber: userDetails['mobile'],

email: userDetails['email']);

 

flutterwave = Flutterwave(

 

context: context,

style: style,

publicKey: "public key of flutterwave here",

currency: "currency here",

txRef: userDetails['id'].toString() + '_' + DateTime.now().toString(),

amount: addMoney.toString(),

customer: customer,

paymentOptions: "ussd, card, barter, payattitude, account",

customization: Customization(title: "title"),

isTestMode: true or false,

 

);
```

* <strong> Note : File Location "project/lib/pages/NavigatorPages/paystackpayment.dart" </strong>

```flutter
plugin.initialize(publicKey: 'your paystack publickey here');
```

* <strong> Note : File Location "project/lib/pages/NavigatorPages/razorpaypage.dart" </strong>

```flutter
var options = {

'key': 'razor pay key here',

'amount': addMoney * 100,

'name': userDetails['name'],


```

12. change app version

* <strong> Note : File Location "project/pubsec.yaml" </strong>

```flutter
version: 1.0.2+3

```

13. create release keys by running command in terminal

<strong>   note: change anyname with any specific name you like, </strong>

 * keytool -genkey -v -keystore ~/[name].jks -keyalg RSA -keysize 2048 -validity 10000 -alias [your_alias_name]-storetype JKS


* after running this command give the data asked in the terminal. after that it will save the jks file and display the location

14. replace the jks key details in file,

* <strong> Note : File Location "project/android/key.properties as given below" </strong>
	
```flutter
storePassword=password you entered while creating jks file

keyPassword=password you entered while creating jks file

keyAlias=alias name you given in the command for creating jks file

storeFile=jks file name with the location like ../../../jks
```

15. Generate SHA-1 and SHA-256 keys from the project

	* you will be able to get these keys in two ways these are

		* in terminal go to folder 'project/android/' and run the command './gradlew signinReport' then you will get debug and release SHA-1 and SHA-256

		* Run the below command in the terminal to get SHA keys
			
			* Key tool -genkey -v -keystore release.keystore -alias [your_alias_name] -keyalg RSA -keysize 2048 -validity 10000

	

<br>

Finally copy that debug and release keys and paste those in Firebase where

Click Settings icon (presented right on project overview ) -> project settings -> Your App section -> SHA certificate fingerprints click add button and paste & Submit.



16. Google cloud Setup

* Enable below services in cloud console

	* Places API - which helps to get address while typing keys from the app

	* Maps SDK For Android

	* Google Sheets API - For translation sheets

	* Android Device Verification - For Identify the App name to append in OTP from Firebase

	* Geolocation APIs like distance matrix, geocoding, geolocations, Maps JavaScript, Maps static.


17. to download apk file run "flutter build apk --release" in terminal from project location, and you will get apk file in folder - project/build/app/outputs/apk/release/app-release.apk

 

18. to download app bundle file run "flutter build appbundle --release" in terminal from project location, and you will get app bundle file in folder - project/build/app/outputs/bundle/release/app-release.aab

 

19. after uploading app in playstore, then you will get a sha1 key and sha256 key from playstore, add those keys in your project as

 

Click Settings icon (presented right on project overview ) -> project settings -> Your App section -> SHA certificate fingerprints click add button and paste & Submit.


