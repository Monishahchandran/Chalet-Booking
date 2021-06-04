
# MFSDKiOS

# Introduction
MyFatoorah SDK v2, is an enhanced and improved SDK version that will simplify the integration with MyFatoorah payment platform through simple straight forward steps.


[# Prerequisites ](https://myfatoorah.readme.io/v2.0/docs/prerequisites-2)
In order to use MyFatoorah SDK on live environment, you have to consider some points to be done before you proceed with your live integration. Here you are the list that should be done and completed before going live with your account:

- You have to Create [ Live Account ](https://myfatoorah.readme.io/v2.0/docs/create-live-account) and get the account approved
- You have to get the API feature activated, you have to communicate with your account manager to enable it
- Get the API key that will be used within the integration
- If you are in need to have a [Direct Payment](https://myfatoorah.readme.io/v2.0/docs/direct-payment) integration working within your app, please communicate with your account manager to enable this feature for your as well


# Demo Information
Demo account information

    baseURL: https://apitest.myfatoorah.com
    APIKey(Token): rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL

    API_Direct_Payment_Key(Token): Tfwjij9tbcHVD95LUQfsOtbfcEEkw1hkDGvUbWPs9CscSxZOttanv3olA6U6f84tBCXX93GpEqkaP_wfxEyNawiqZRb3Bmflyt5Iq5wUoMfWgyHwrAe1jcpvJP6xRq3FOeH5y9yXuiDaAILALa0hrgJH5Jom4wukj6msz20F96Dg7qBFoxO6tB62SRCnvBHe3R-cKTlyLxFBd23iU9czobEAnbgNXRy0PmqWNohXWaqjtLZKiYY-Z2ncleraDSG5uHJsC5hJBmeIoVaV4fh5Ks5zVEnumLmUKKQQt8EssDxXOPk4r3r1x8Q7tvpswBaDyvafevRSltSCa9w7eg6zxBcb8sAGWgfH4PDvw7gfusqowCRnjf7OD45iOegk2iYSrSeDGDZMpgtIAzYVpQDXb_xTmg95eTKOrfS9Ovk69O7YU-wuH4cfdbuDPTQEIxlariyyq_T8caf1Qpd_XKuOaasKTcAPEVUPiAzMtkrts1QnIdTy1DYZqJpRKJ8xtAr5GG60IwQh2U_-u7EryEGYxU_CUkZkmTauw2WhZka4M0TiB3abGUJGnhDDOZQW2p0cltVROqZmUz5qGG_LVGleHU3-DgA46TtK8lph_F9PdKre5xqXe6c5IYVTk4e7yXd6irMNx4D4g1LxuD8HL4sYQkegF2xHbbN8sFy4VSLErkb9770-0af9LT29kzkva5fERMV90w

[# Test Cards ](https://myfatoorah.readme.io/v2.0/docs/test-cards)

# Installation
### Cocoapod

You can download MFSDK by adding this line to your `Podfile`

- For Swift
```
pod 'MyFatoorah', '2.0.90'
```
- For Objective - C
```
pod 'MyFatoorah', '2.0.90'
```

Then in your terminal :
- first run this command to get latest pod:
```
pod repo update
```
- then run  install command:
```
pod install
```

```If you are using XCode 12.3, make sure you have last version for Cocoapod that is 1.10```

### Swift Package Manager
You can download MFSDK by adding the `https://dev.azure.com/myfatoorahsc/_git/MF-SDK-iOS-Demo` repository as a Swift Package.

# Usage

1. Import framework in AppDelegate
```
import MFSDK
```

2. Add below code in didFinishLaunchingWithOptions method


# Swift 
```Swift
func application(_ application: UIApplication, didFinishLaunchingWithOptions launchOptions: [UIApplication.LaunchOptionsKey: Any]?) -> Bool {
// Override point for customization after application launch.
// set up your MyFatoorah Merchant details
MFSettings.shared.configure(token: Put your token here, baseURL: Put base url)

// you can change color and title of navigation bar
let them = MFTheme(navigationTintColor: .white, navigationBarTintColor: .lightGray, navigationTitle: "Payment", cancelButtonTitle: "Cancel")
MFSettings.shared.setTheme(theme: them)
return true
}
```

# Objective - C
```objc
- (BOOL)application:(UIApplication *)application didFinishLaunchingWithOptions:(NSDictionary *)launchOptions {
// set up your MyFatoorah Merchant details
[[MFSettings shared] configureWithToken:@ Put your token here baseURL: @ Put base url];

// you can change color and title of navigation bar
MFTheme* theme = [[MFTheme alloc] initWithNavigationTintColor:[UIColor whiteColor] navigationBarTintColor:[UIColor lightGrayColor] navigationTitle:@"Payment" cancelButtonTitle:@"Cancel"];
[[MFSettings shared] setThemeWithTheme:theme];

return YES;
}

```

```
After finish testing don't forget to replace the demo token with your live token.  
Also don't forget to change the baseURL To live URL
```
## Integration Types
In this section of the documentation, we are going to explain the different types of integration with MyFatoorah SDK . This will help the development phase to get more understanding about the exact functions needed that will serve the business accordingly and will save the development time and efforts to project the required business needs on the desired integration. We are having many types of integration, that can be done through SDK. We are listing below the different types of integration with MyFatoorah, this list is expandable by time :) but we are listing what you can use immediately for your integration:

[Gateway Integration](#Gateway-Integration)
[Direct Payment](#Direct-Payment)
[Send Payment (Offline)](#Send-Payment-(Offline))


# Gateway Integration  

This is the most common known type of integration that you simply needs to accelerate your business applications with payment gateway integration in simple few steps with the minimum development efforts, and with various capabilities. From technical point of view you have to get this integration done within your application with 2 simple calls. The 2 calls to achieve this will be as following:

- Initiate Payment this step will simply return you all available [Payment Methods](https://myfatoorah.readme.io/v2.0/docs/payment-methods) for the account with the actual charge that the customer will pay on the gateway.To know more about the function and it's models along with each accepted parameters and possible values  [here](https://myfatoorah.readme.io/v2.0/docs/api-initiate-payment)
```
This step is not required you can ignore it and go to the execute payment step if you now the PaymentMethodId you want to pay with it 
or you can call it only one time  to know the PaymentMethodIds allowed to you 
```

- Execute Payment once the payment has been initiated, this step will do execute the actual transaction creation at MyFatoorah platform and will open a screen to your user to pay on it.To know more about the function and it's models along with each accepted parameters and possible values  [here](https://myfatoorah.readme.io/v2.0/docs/api-execute-payment)


# Swift 

```swift
        // initiatePayment 
        let invoiceValue = 5.0
        var selectedPaymentMethod = 1
        let initiatePayment = MFInitiatePaymentRequest(invoiceAmount: invoiceValue, currencyIso: .kuwait_KWD)
        MFPaymentRequest.shared.initiatePayment(request: initiatePayment, apiLanguage: .english) { [weak self] (response) in
            switch response {
            case .success(let initiatePaymentResponse):
                var paymentMethods = initiatePaymentResponse.paymentMethods
                if let paymentMethods = initiatePaymentResponse.paymentMethods, !paymentMethods.isEmpty {
                    selectedPaymentMethod = paymentMethods[0].paymentMethodId
                }
            case .failure(let failError):
                print(failError)
            }
        }
        
    
    // executePayment 
        let request = MFExecutePaymentRequest(invoiceValue: invoiceValue, paymentMethod: paymentMethod.paymentMethodId)
        
        // Uncomment this to add products for your invoice
        // var productList = [MFProduct]()
        // let product = MFProduct(name: "ABC", unitPrice: 1, quantity: 2)
        // productList.append(product)
        // request.invoiceItems = productList
        
        MFPaymentRequest.shared.executePayment(request: request, apiLanguage: .english) { [weak self] (response,invoiceId) in
            switch response {
            case .success(let executePaymentResponse):
                print("\(executePaymentResponse.invoiceStatus ?? "")")
            case .failure(let failError):
                print(failError)
            }
        }
```
# Objective - C 
```objc
        NSDecimalNumber *decimalNumber = [[NSDecimalNumber alloc] initWithDouble:5];
        NSDecimal invoiceValue = [decimalNumber decimalValue];
        MFInitiatePaymentRequest* initiatePayment = [[MFInitiatePaymentRequest alloc] initWithInvoiceAmount:invoiceValue currencyIso:MFCurrencyISOKuwait_KWD];
        [[MFPaymentRequest shared] initiatePaymentWithRequest:initiatePayment apiLanguage:MFAPILanguageEnglish completion:^(MFInitiatePaymentResponse * initiatePaymentResponse, MFFailResponse * failResponse) {
            if (initiatePaymentResponse != NULL) {
                if ([initiatePaymentResponse.paymentMethods count] > 0) {
                    NSLog(@"%@",initiatePaymentResponse);
                }
            } else {
                    NSLog(@"%@",failResponse);
                    
                }
            }
        }];
    
        MFExecutePaymentRequest* request = [[MFExecutePaymentRequest alloc] initWithInvoiceValue:invoiceValue paymentMethod:_paymentMethodId];
        //         Uncomment this to add products for your invoice
        // NSMutableArray* productList = [[NSMutableArray alloc] init];
        // MFProduct* product = [[MFProduct alloc] initWithName:@"ABC" unitPrice:1 quantity:2];
        // [productList addObject:product];
        // request.invoiceItems = productList;
        [[MFPaymentRequest shared] executePaymentWithRequest:request apiLanguage:MFAPILanguageEnglish completion:^(MFPaymentStatusResponse * paymentStatusResponse, MFFailResponse * failResponse, NSString* invoiceId) {
            if (paymentStatusResponse != NULL) {
                NSLog(@"%@",paymentStatusResponse);
            } else {
                NSLog(@"%@",failResponse);
            }
        }];
    
```
# Apple Pay Payment
## For iOS 13.0 and above
### Swift
```swift
    let invoiceValue = 5.0
    let paymentMethod = 2 // if you don't Know this you have to call initiatePayment
    let request = MFExecutePaymentRequest(invoiceValue: invoiceValue, paymentMethod: 2)
    MFPaymentRequest.shared.executeApplePayPayment(request: request, apiLanguage: .arabic) { [weak self] response, invoiceId  in
        switch response {
        case .success(let executePaymentResponse):
            if let invoiceStatus = executePaymentResponse.invoiceStatus {
                self?.showSuccess(invoiceStatus)
            }
        case .failure(let failError):
            self?.showFailError(failError)
        }
    }
 ```
 ### Objective - C
```objc
    NSDecimalNumber * decimalNumber = [NSDecimalNumber decimalNumberWithString:self.amountTextField.text];
    NSDecimal invoiceValue = [decimalNumber decimalValue];
    
    MFExecutePaymentRequest* request = [[MFExecutePaymentRequest alloc] initWithInvoiceValue:invoiceValue paymentMethod:paymentMethodId];
    [[MFPaymentRequest shared] executeApplePayPaymentWithRequest:request apiLanguage:MFAPILanguageEnglish completion:^(MFPaymentStatusResponse * response, MFFailResponse * error, NSString * invoiceId) {
        [self stopLoading];
        if (response != NULL) {
            if (response.invoiceStatus != NULL) {
                [self showSuccess:response.invoiceStatus];
            } else {
                [self showFailError:error];
            }
        }  else {
                [self showFailError:error];
        }
    }];
 ```
## If your app support iOS versions below iOS 13.0,  you should follow this steps:
### Setup
### To use Apple Pay payment, first your account should has Apple Pay payment method enabled then follow this steps:

1- Go to your app target and click Info tab, scroll bottom and add URL type, set identifier filed with your bundle id
 or any thing else and add URL Schemes with say 'urlScheme' `Make sure it is Unique url schema for your APP `

2- create your request and call 'executeApplePayPayment' method, please note you have to pass `urlScheme`
 argument with URL Scheme 'urlScheme' that we added it in first step:
 # Swift
```swift
    let invoiceValue = 5.0
    let paymentMethod = 2 // if you don't Know this you have to call initiatePayment
    let request = MFExecutePaymentRequest(invoiceValue: invoiceValue, paymentMethod: 2)
    MFPaymentRequest.shared.executeApplePayPayment(request: request, urlScheme: "urlScheme", apiLanguage: .arabic) { [weak self] response, invoiceId  in
        switch response {
        case .success(let executePaymentResponse):
            if let invoiceStatus = executePaymentResponse.invoiceStatus {
                self?.showSuccess(invoiceStatus)
            }
        case .failure(let failError):
            self?.showFailError(failError)
        }
    }
 ```
 # Objective - C
```objc
    NSDecimalNumber * decimalNumber = [NSDecimalNumber decimalNumberWithString:self.amountTextField.text];
    NSDecimal invoiceValue = [decimalNumber decimalValue];
    
    MFExecutePaymentRequest* request = [[MFExecutePaymentRequest alloc] initWithInvoiceValue:invoiceValue paymentMethod:paymentMethodId];
    [[MFPaymentRequest shared] executeApplePayPaymentWithRequest:request urlScheme:@"urlScheme" apiLanguage:MFAPILanguageEnglish completion:^(MFPaymentStatusResponse * response, MFFailResponse * error, NSString * invoiceId) {
        [self stopLoading];
        if (response != NULL) {
            if (response.invoiceStatus != NULL) {
                [self showSuccess:response.invoiceStatus];
            } else {
                [self showFailError:error];
            }
        }  else {
                [self showFailError:error];
        }
    }];
 ```
3- Then we should to listen to apple pay to dismiss apple payment so we should implement 
`application(_ app: UIApplication, open url: URL, options: [UIApplication.OpenURLOptionsKey : Any] = [:]) -> Bool`
 method in AppDelegate and check url query items and if url has query item with key `MFConstants.paymentId`, 
 we then post notification with `MFConstants.applePayNotificationName` to check payment status:
 ## Swift
 ```swift
 func application(_ app: UIApplication, open url: URL, options: [UIApplication.OpenURLOptionsKey : Any] = [:]) -> Bool {
     if let paymentId = url[MFConstants.paymentId] {
         NotificationCenter.default.post(name: .applePayCheck, object: paymentId)
     }
     return true
 }
 ```
 ## Objective - C

 ```objc
 - (BOOL)application:(UIApplication *)app openURL:(NSURL *)url options:(NSDictionary<UIApplicationOpenURLOptionsKey,id> *)options {
     if (url[MFConstants.paymentId] != NULL) {
         [[NSNotificationCenter defaultCenter] postNotificationName:MFConstants.applePayNotificationName object:url[MFConstants.paymentId]];
     }
     return true;
 }
 ```
 >## Please note if your app have `SceneDelegate` so you should implement `func scene(_ scene: UIScene, openURLContexts URLContexts: Set<UIOpenURLContext>)` instead of `func application(_ app: UIApplication, open url: URL, options: [UIApplication.OpenURLOptionsKey : Any] = [:]) -> Bool`
 ## Swift
 ```Swift
 @available(iOS 13.0, *)
 func scene(_ scene: UIScene, openURLContexts URLContexts: Set<UIOpenURLContext>) {
     if let url = URLContexts.first?.url {
        if let paymentId = url[MFConstants.paymentId] {
             NotificationCenter.default.post(name: .applePayCheck, object: paymentId)
         }
     }
 }
 ```
 ## Objective - C
 ```objc
 - (void)scene:(UIScene *)scene openURLContexts:(NSSet *)URLContexts {

     NSURL *url = URLContexts.allObjects.firstObject.URL;    
     if (url[MFConstants.paymentId] != NULL) {
         [[NSNotificationCenter defaultCenter] postNotificationName:MFConstants.applePayNotificationName object:url[MFConstants.paymentId]];
     }
 }
 ```
 ## Test
 ### Please check this [link](https://developer.apple.com/apple-pay/sandbox-testing/), it is an apple document explain how test apple pay in your device.


# Direct Payment 
This integration will give you a full control of the payment experience to be initiated, executed and confirmed within your application full theme and experience. Never worry any more about confusing your customers' experience, here you will define the way it should look like and how it can be done till final check out.

```
Please note that not all Payment Methods are supporting Direct Payment feature, please refer to your account manager for more details
```
# steps to do direct payment
1- To know which payment method allow direct payment for you have to call  `initiatePayment` method at least one time to know the `paymentMethodId`  for the next step .
2- Collect card info from user 
`MFCardInfo(cardNumber: "51234500000000081", cardExpiryMonth: "05", cardExpiryYear: "21", cardSecurityCode: "100", saveToken: false)`
If you want the bank to save your credit card info and generate a token for you for next payment  you have to sent `saveToken: true`  you will get a token and encrypted card info on the the response you must save them on your server for next payment. 
If you have the token create card model like this  `MFCardInfo(cardToken: "put your token here")` 

3- Create `MFExecutePaymentRequest(invoiceValue: invoiceValue, paymentMethod: 2)` with your amount you want the user to pay it  and the `paymentMethodId` from step one 
4- call `executeDirectPayment` method with `MFExecutePaymentRequest` and `MFCardInfo` and wait the response.
The response will contain :-
- `paymentId` you can save it your side to check the payment status any time. 
-  `token`  and encrypted  `cardInfo` to save them for next payment. 
- `PaymentStatus` a model contain all information about the invoice and the transaction like 
 `invoiceID,invoiceStatus, invoiceReference, customerReference, createdDate,expiryDate, invoiceValue,comments, customerName, customerMobile, customerEmail, userDefinedField, invoiceDisplayValue,let invoiceItems, invoiceTransactions`




# Swift 
```swift
         let card = MFCardInfo(cardNumber: "51234500000000081", cardExpiryMonth: "05", cardExpiryYear: "21", cardHolderName: "John", cardSecurityCode: "100", saveToken: true) //MFCardInfo(cardToken: "token")
         // card.bypass = false // default is true

        let invoiceValue = 5.0
        
        let paymentMethod = 2 // if you don't Know this you have to call initiatePayment
        let request = MFExecutePaymentRequest(invoiceValue: invoiceValue, paymentMethod: 2)
        MFPaymentRequest.shared.executeDirectPayment(request: request, cardInfo: card, apiLanguage: .english) { [weak self] response, invoiceId in
            switch response {
            case .success(let directPaymentResponse):
                if let cardInfoResponse = directPaymentResponse.cardInfoResponse, let card = cardInfoResponse.cardInfo {
                    print("Status: with card number \(card.number)")
                }
                if let invoiceId = invoiceId {
                    print("Success with invoiceId \(invoiceId)")
                }
            case .failure(let failError):
                print("Error: \(failError.errorDescription)")
                if let invoiceId = invoiceId {
                    print("Fail: \(failError.statusCode) with invoiceId \(invoiceId)")
                }
            }
        }
```

# Objective - C 
```objc
   MFExecutePaymentRequest* request = [self getExecutePaymentRequest:paymentMethodId];

    MFCardInfo* card = [self getCardInfo];

    [self startLoading];

    [[MFPaymentRequest shared] executeDirectPaymentWithRequest:request cardInfo:card apiLanguage:MFAPILanguageEnglish completion:^(MFDirectPaymentResponse * response, MFFailResponse * error, NSString * invoiceId) {


        if (response !=NULL) {

            if (response.cardInfoResponse != NULL) {

                NSLog(@"%@",[NSString stringWithFormat:@"Status: with card number: %@", response.cardInfoResponse.cardInfo.number]);

            }

            if (invoiceId != NULL) {
                NSLog(@"%@", [NSString stringWithFormat:@"Success with invoice id %@", invoiceId ]);

            }

        }

    }];

```

# Recurring Payment
## Swift
```swift
 // MARK: - Recurring Payment
extension ViewController {

    func executeRecurringPayment(paymentMethodId: Int) {
        let request = MFExecutePaymentRequest(invoiceValue: 5.000 , paymentMethod: paymentMethodId)
        let card = MFCardInfo(cardNumber: "", cardExpiryMonth: "", cardExpiryYear: "", cardSecurityCode: "")
        MFPaymentRequest.shared.executeRecurringPayment(request: request, cardInfo: card, recurringIntervalDays: 10, recurringType: .custom(iteration: 5), apiLanguage: .english) { [weak self] (response, invoiceId) in
            switch response {
            case .success(let directPaymentResponse):
                if let cardInfoResponse = directPaymentResponse.cardInfoResponse, let card = cardInfoResponse.cardInfo {
                    print("Status: with card number: \(card.number)")
                    print("Status: with recurring Id: \(cardInfoResponse.recurringId ?? "")")


                }
                if let invoiceId = invoiceId {
                    print("Success with invoice id \(invoiceId)")
                } else {
                    print("Success")
                }
            case .failure(let failError):
                print("Error: \(failError.errorDescription)")
                if let invoiceId = invoiceId {
                    print("Fail: \(failError.statusCode) with invoice id \(invoiceId)")
                } else {
                    print("Fail: \(failError.statusCode)")
                }
            }
        }


    }

    func cancelRecurringPayment(recurringId: String) {
        MFPaymentRequest.shared.cancelRecurringPayment(recurringId: recurringId, apiLanguage: .english) { [weak self] (result) in
            switch result {
            case .success(let isCanceled):
                if isCanceled {
                    print("Success")
                }

            case .failure(let failError):
                self?.showFailError(failError)
            }
        }
    }

}
```

## Objective - C 
```objc
// MARK: - Recurring Payment
-(void) executeRecurringPayment:(NSInteger) paymentMethodId {
    NSDecimalNumber *decimalNumber = [[NSDecimalNumber alloc] initWithDouble:5];
    NSDecimal value = [decimalNumber decimalValue];
    MFExecutePaymentRequest* request = [[MFExecutePaymentRequest alloc] initWithInvoiceValue:value paymentMethod:paymentMethodId];
    MFCardInfo* card = [[MFCardInfo alloc] initWithCardNumber:@"" cardExpiryMonth:@"" cardExpiryYear:@"" cardSecurityCode:@""];
    [[MFPaymentRequest shared] executeRecurringPaymentWithRequest:request cardInfo:card recurringIntervalDays:10 recurringType:MFRecurringTypeEnumCustom iteration:4 apiLanguage:MFAPILanguageEnglish completion:^(MFDirectPaymentResponse * response, MFFailResponse * error, NSString * invoiceId) {
        [self stopLoading];
        if (response !=NULL) {
            if (response.cardInfoResponse != NULL) {
                 // [NSString stringWithFormat:@"Status: with card number: %@", response.cardInfoResponse.cardInfo.number];
            }
            if (invoiceId != NULL) {
                //[NSString stringWithFormat:@"Success with invoice id %@", invoiceId ];
            } else {
                // @"error";
            }
        }
    }];
}

-(void) cancelRecurringPayment:(NSString *) recurringId {
    [[MFPaymentRequest shared] cancelRecurringPaymentWithRecurringId:recurringId apiLanguage:MFAPILanguageEnglish completion:^(BOOL isCanceled, MFFailResponse * error) {
           if (isCanceled != NULL) {
               NSLog(@"Canceled");
           } else {
               NSLog(@"error");
           }
       }];
}
```
# Send Payment (Offline)
In this type of integration, we are providing a simple straight forward Way that will allow you to generate a payment link that can be sent by any channel we support and collect it once it's paid by your customer. This kind of payment will facilitate your collection if you have a non-store platforms and would like to introduce a niche to your business. You can decide how are you going to send the payment link either SMS, email, link or ALL. Just pass the needed parameters and your customer will have a link to pay at his /her fingertip but be sure to pass the needed information for your customer to assure that it will be received.

# Swift 
```swift

        let invoiceValue = 5.0
        var notificationOption : MFNotificationOption =  .all
        /*
         notificationOption = .sms
         notificationOption = .email
         notificationOption = .link
         */
        
        let invoice = MFSendPaymentRequest(invoiceValue: invoiceValue, notificationOption: notificationOption, customerName: "customerName")
        
        invoice.customerEmail = "a@b.com"// must be email Required if you choose notificationOption .all or  .email
        invoice.customerMobile = "mobile no"//Required if you choose notificationOption .all or .sms
        invoice.mobileCountryIsoCode = MFMobileCountryCodeISO.kuwait.rawValue
        
        MFPaymentRequest.shared.sendPayment(request: invoice, apiLanguage: .english) { [weak self] (result) in
            switch result {
            case .success(let sendPaymentResponse):
                if let invoiceURL = sendPaymentResponse.invoiceURL {
                    print("result: RedirectUrl is \(invoiceURL)")
                }
            case .failure(let failError):
                print("Error: \(failError)")
            }
        }
        
    
```
# Objective - C 
```objc
    NSDecimalNumber *decimalNumber = [[NSDecimalNumber alloc] initWithDouble:5];
    NSDecimal invoiceValue = [decimalNumber decimalValue];
    MFSendPaymentRequest* request = [[MFSendPaymentRequest alloc] initWithInvoiceValue:invoiceValue notificationOption:MFNotificationOptionAll customerName:@"Test"];
    request.mobileCountryIsoCode = [MFEnumRawValue rawValueWithMobileISO:MFMobileCountryCodeISOKuwait];
    [[MFPaymentRequest shared] sendPaymentWithRequest:request apiLanguage:MFAPILanguageEnglish completion:^(MFSendPaymentResponse * sendPaymentResponse, MFFailResponse * failResponse) {
        
        if(sendPaymentResponse != NULL) {
            NSLog(@"%@",sendPaymentResponse.invoiceURL);
            
        } else {
            NSLog(@"%@",failResponse.errorDescription);
        }
        
    }];
```



### You can use both MFSDKDemo-Swift and  MFSDKDemo-Objective-C to know how use MFSDK.

