//
//  Utils.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 27/04/21.
//

import Foundation
import UIKit
import SwiftMessages
func makePath(view:UIView) {
    let path = UIBezierPath()
    path.move(to: CGPoint(x: 0.0, y: 0.0))
    path.addLine(to: CGPoint(x: 0, y: 90.0))
    
    
    path.addQuadCurve(to: CGPoint(x: view.frame.size.width, y: 90.0), controlPoint: CGPoint(x: view.frame.size.width/2, y: 250))
    
    path.addLine(to: CGPoint(x: view.frame.size.width, y: view.frame.size.height))
    path.addLine(to: CGPoint(x: 0.0, y: view.frame.size.height))
   
    path.close()
    
    let shapeLayer = CAShapeLayer()
    shapeLayer.path = path.cgPath
    view.layer.mask = shapeLayer

    view.backgroundColor = UIColor.darkGray
    
    
}



func pathInnerCurvedForView(givenView: UIView, curvedPercent:CGFloat) ->UIBezierPath
    {
        let arrowPath = UIBezierPath()
        arrowPath.move(to: CGPoint(x:0, y:0))
        arrowPath.addLine(to: CGPoint(x:givenView.bounds.size.width, y:0))
        arrowPath.addLine(to: CGPoint(x:givenView.bounds.size.width, y:givenView.bounds.size.height))
        arrowPath.addQuadCurve(to: CGPoint(x:0, y:givenView.bounds.size.height), controlPoint: CGPoint(x:givenView.bounds.size.width/2, y:givenView.bounds.size.height-givenView.bounds.size.height*curvedPercent))
        arrowPath.addLine(to: CGPoint(x:0, y:0))
        arrowPath.close()
        
        return arrowPath
    }

func pathOuterCurvedForView(givenView: UIView, curvedPercent:CGFloat) ->UIBezierPath
{
    let arrowPath = UIBezierPath()
    arrowPath.move(to: CGPoint(x:0, y:0))
    arrowPath.addLine(to: CGPoint(x:givenView.bounds.size.width, y:0))
    arrowPath.addLine(to: CGPoint(x:givenView.bounds.size.width, y:givenView.bounds.size.height - (givenView.bounds.size.height*curvedPercent)))
    arrowPath.addQuadCurve(to: CGPoint(x:0, y:givenView.bounds.size.height - (givenView.bounds.size.height*curvedPercent)), controlPoint: CGPoint(x:givenView.bounds.size.width/2, y:givenView.bounds.size.height))
    arrowPath.addLine(to: CGPoint(x:0, y:0))
    arrowPath.close()
    
    return arrowPath
}


func applyInnerCurvedPath(givenView: UIView,curvedPercent:CGFloat) {
    guard curvedPercent <= 1 && curvedPercent >= 0 else{
        return
    }
    
    let shapeLayer = CAShapeLayer(layer: givenView.layer)
    shapeLayer.path = pathInnerCurvedForView(givenView: givenView,curvedPercent: curvedPercent).cgPath
    shapeLayer.frame = givenView.bounds
    shapeLayer.masksToBounds = true
    givenView.layer.mask = shapeLayer
}

func applyOuterCurvedPath(givenView: UIView,curvedPercent:CGFloat) {
    guard curvedPercent <= 1 && curvedPercent >= 0 else{
        return
    }
    
    let shapeLayer = CAShapeLayer(layer: givenView.layer)
    shapeLayer.path = pathOuterCurvedForView(givenView: givenView,curvedPercent: curvedPercent).cgPath
    shapeLayer.frame = givenView.bounds
    shapeLayer.masksToBounds = true
    givenView.layer.mask = shapeLayer
}

func setupForCustomNavigationTitle(self:UIViewController, text:String? = nil){

    let navLabel = UILabel()
    let navTitle = NSMutableAttributedString(string: "Aby", attributes:[
                                                NSAttributedString.Key.foregroundColor: UIColor.green,
                                                NSAttributedString.Key.font: UIFont(name: "Roboto-BoldItalic", size: 25)! ])

    navTitle.append(NSMutableAttributedString(string: " Chalet", attributes:[
                                                NSAttributedString.Key.font: UIFont(name: "Roboto-BoldItalic", size: 25)! ,
                                                NSAttributedString.Key.foregroundColor: UIColor.white]))

    navLabel.attributedText = navTitle
    self.navigationItem.titleView = navLabel
}

func setGradientColorForPackageUnselectedCell(view: UIView) {
    let bottomGradient = CAGradientLayer()
    bottomGradient.frame = view.bounds
    
    bottomGradient.colors =  [#colorLiteral(red: 0.1960784314, green: 0.3843137255, blue: 0.4666666667, alpha: 1).cgColor, #colorLiteral(red: 0.168627451, green: 0.3294117647, blue: 0.4078431373, alpha: 1).cgColor,]
    view.layer.insertSublayer(bottomGradient, at: 0)//addSublayer(bottomGradient)
}

func setGradientColorForPackageSelectedCell(view: UIView) {
    let bottomGradient = CAGradientLayer()
    bottomGradient.frame = view.bounds
    
    bottomGradient.colors =  [#colorLiteral(red: 0.168627451, green: 0.3294117647, blue: 0.4078431373, alpha: 1).cgColor, #colorLiteral(red: 0.1960784314, green: 0.3843137255, blue: 0.4666666667, alpha: 1).cgColor,]
    view.layer.insertSublayer(bottomGradient, at: 0)//addSublayer(bottomGradient)
}

//MARK:- PickerViewHeight

public func heightForPicker(height:CGFloat) -> CGFloat
{
    if UIDevice.current.userInterfaceIdiom == . pad {
        if height == 1194 {
            return 377
        }else if height == 1366 {
            return 442
        } else {
            return 357
        }
    }else {
        if height == 568.0 {
            return 253 - 20
        }
        else if height == 667 {
            return 260 - 25
        }
        else if height == 736 {
            return 271 - 30
        }
        else if height == 812 {
            return 335 - 40
        }
        else {
            return 346 - 50
            // if height >= 896
        }
    }
}

func showDefaultAlert(viewController: UIViewController, title: String, msg: String) {
    let alert = UIAlertController(title: title, message: msg, preferredStyle: .alert)
    alert.addAction(UIAlertAction(title: "OK".localized(), style: .default, handler: { (action) in
    }))
    viewController.present(alert, animated: true, completion: nil)
}

func isValidEmail(email:String) -> Bool {
    
    let emailRegEx = "[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,64}"
    let emailTest = NSPredicate(format:"SELF MATCHES %@", emailRegEx)
    return emailTest.evaluate(with: email)
}


func redirectingToHomeScreen(index:Int? = nil){
    let storyboard = UIStoryboard.init(name: "Main", bundle: nil)
    let loginScreen = storyboard.instantiateViewController(withIdentifier: "CustomTabbarController") as! CustomTabbarController
    
    loginScreen.selectedIndex = index ?? 0
    appDelegate.window?.rootViewController = loginScreen
}

func limitValidation(string: String, minLength: Int, maxLength: Int) -> Bool {
    if maxLength > 0{
        return (string.count >= minLength && string.count <= maxLength)
    } else {
        return (string.count >= minLength)
    }
    
}

func showAlertWithActivityIndicator(self:UIViewController, show:Bool, message:String){
    
//    let alert: UIAlertView = UIAlertView(title: "", message: message, delegate: nil, cancelButtonTitle: "Okay")
//    let alert = UIAlertController(title: "", message: message, preferredStyle: .alert)
//    let action = UIAlertAction(title: "Okay", style: .cancel, handler: nil)
//    alert.addAction(action)
//    let loadingIndicator: UIActivityIndicatorView = UIActivityIndicatorView(frame: CGRect(x: 50, y: 10, width: 37, height: 37)) as UIActivityIndicatorView
//    loadingIndicator.center = self.view.center
//    loadingIndicator.hidesWhenStopped = true
//    loadingIndicator.style = UIActivityIndicatorView.Style.large
//    loadingIndicator.startAnimating()
//
//    alert.setValue(loadingIndicator, forKey: "accessoryView")
//    loadingIndicator.startAnimating()
//
//    alert.show()
    
    
    
//    let alert = UIAlertController(title: "", message: message, preferredStyle: .alert)
//    let action = UIAlertAction(title: "Okay", style: .cancel, handler: nil)
//    alert.addAction(action)
//    let activityIndicator = UIActivityIndicatorView(frame: CGRect(x: 50, y: 10, width: 37, height: 37)) as UIActivityIndicatorView
//    activityIndicator.style = .large
//    activityIndicator.translatesAutoresizingMaskIntoConstraints = false
//    activityIndicator.isUserInteractionEnabled = false
//    activityIndicator.startAnimating()
//    activityIndicator.center = alert.view.center
//    activityIndicator.hidesWhenStopped = true
//    alert.view.addSubview(activityIndicator)
////    alert.view.heightAnchor.constraint(equalToConstant: 95).isActive = true
////
////    activityIndicator.centerXAnchor.constraint(equalTo: alert.view.centerXAnchor, constant: 0).isActive = true
////    activityIndicator.leadingAnchor.constraint(equalTo: alert.view.leadingAnchor, constant: 10).isActive = true
////    activityIndicator.bottomAnchor.constraint(equalTo: alert.view.bottomAnchor, constant: -10).isActive = true
//
//    self.present(alert, animated: true)
    
    
    
    let alert = UIAlertController(title: "Sender ...", message: nil, preferredStyle: .alert)
    let activityIndicator = UIActivityIndicatorView(style: .large)
    activityIndicator.translatesAutoresizingMaskIntoConstraints = false
    activityIndicator.isUserInteractionEnabled = false
    activityIndicator.startAnimating()
//    activityIndicator.transform = CGAffineTransform(scaleX: 1.4, y: 1.4);

    alert.view.addSubview(activityIndicator)
    alert.view.heightAnchor.constraint(equalToConstant: 95).isActive = true
            
    activityIndicator.centerXAnchor.constraint(equalTo: alert.view.centerXAnchor, constant: 0).isActive = true
    activityIndicator.bottomAnchor.constraint(equalTo: alert.view.bottomAnchor, constant: -20).isActive = true
            
    self.present(alert, animated: true)
}

func showActivityIndicator(self: UIViewController, show: Bool, message:String) {
    var strLabel = UILabel()
    let effectView = UIVisualEffectView(effect: UIBlurEffect(style: .light))
    var activityIndicator = UIActivityIndicatorView()
        if show {
            strLabel = UILabel(frame: CGRect(x: 55, y: 0, width: 400, height: 66))
            strLabel.text = message
            strLabel.font = UIFont(name: "Roboto-Medium", size: 12)
            strLabel.numberOfLines = 0
           
            strLabel.textColor = .white
            effectView.backgroundColor = #colorLiteral(red: 0.1176470588, green: 0.262745098, blue: 0.3333333333, alpha: 1)
            effectView.frame = CGRect(x: self.view.frame.midX - strLabel.frame.width/2, y: self.view.frame.midY - strLabel.frame.height/2 , width: 300, height: 66)
            effectView.layer.cornerRadius = 15
            effectView.layer.masksToBounds = true
            activityIndicator = UIActivityIndicatorView(style: .medium)
            activityIndicator.color = .white
            activityIndicator.frame = CGRect(x: 0, y: 0, width: 66, height: 66)
            activityIndicator.startAnimating()
            effectView.contentView.addSubview(activityIndicator)
            effectView.contentView.addSubview(strLabel)
            activityIndicator.transform = CGAffineTransform(scaleX: 1.4, y: 1.4);
            effectView.center = self.view.center
            self.view.addSubview(effectView)
            
            
        } else {
            strLabel.removeFromSuperview()
            effectView.removeFromSuperview()
            activityIndicator.removeFromSuperview()
            activityIndicator.stopAnimating()
        }
    }


func openAlertPopup(selfVc:UIViewController,alertMessage:String? = nil, showAlert:Bool){
   
    guard let alertPopup = UIStoryboard(name: "Profile", bundle: Bundle.main).instantiateViewController(withIdentifier: "ProgressAlertVC") as? ProgressAlertVC else {
        return
    }
    alertPopup.message = alertMessage
    alertPopup.show = showAlert
    alertPopup.modalTransitionStyle = .crossDissolve
    alertPopup.modalPresentationStyle = .overCurrentContext
    
    if showAlert {
        selfVc.present(alertPopup, animated: true)
    }else {
        selfVc.dismiss(animated: true, completion: nil)
    }
  
}
//let when = DispatchTime.now() + 5
//DispatchQueue.main.asyncAfter(deadline: when){
//  // your code with delay
//  alert.dismiss(animated: true, completion: nil)
//}

// MARK: - Alert
func showCustomAlert(title:String, message:String, isError: Bool){
    let alertBottomView = MessageView.viewFromNib(layout: .cardView)
    alertBottomView.bodyLabel?.font = UIFont(name: "Roboto-Medium", size: 12)!
    alertBottomView.titleLabel?.font = UIFont(name: "Roboto-Regular", size: 14)!
    
    let bottomGradient = CAGradientLayer()
    if UIDevice.current.userInterfaceIdiom == .pad {
        alertBottomView.configureBackgroundView(width: UIScreen.main.bounds.width - 100  )
        alertBottomView.backgroundHeight =  UIScreen.main.bounds.height / 12
    }
    alertBottomView.configureDropShadow()
    alertBottomView.button?.isHidden = true
   
    bottomGradient.frame = alertBottomView.backgroundView.bounds
    bottomGradient.colors = [#colorLiteral(red: 0.168627451, green: 0.3294117647, blue: 0.4078431373, alpha: 1).cgColor, #colorLiteral(red: 0.1960784314, green: 0.3843137255, blue: 0.4666666667, alpha: 1).cgColor]
    if UIDevice.current.userInterfaceIdiom == .pad {
        bottomGradient.startPoint = CGPoint(x: 0.0, y: 0.0)
        bottomGradient.endPoint = CGPoint(x: 0.0, y: 0.7)
    } else
    {
        bottomGradient.startPoint = CGPoint(x: 0.0, y: 0.0)
        bottomGradient.endPoint = CGPoint(x: 0.0, y: 0.5)
    }
    
    if isError {
        alertBottomView.backgroundView.layer.insertSublayer(bottomGradient, at: 0)
        alertBottomView.configureTheme(.error)
        alertBottomView.configureContent(title: title, body: message, iconImage: UIImage(named: "icn_close_circle_white")!)
        alertBottomView.iconImageView?.isHidden = false
    } else {
        alertBottomView.configureTheme(.success)
        alertBottomView.configureTheme(backgroundColor:#colorLiteral(red: 0.168627451, green: 0.3294117647, blue: 0.4078431373, alpha: 1), foregroundColor: UIColor.white)
        alertBottomView.configureContent(title: title, body: message)
        alertBottomView.iconImageView?.isHidden = true
    }
    
    var config = SwiftMessages.Config()
    config.presentationStyle = .center
    config.duration = .seconds(seconds: 1.0)
    config.dimMode = .gray(interactive: true)
    SwiftMessages.show(config: config, view: alertBottomView)
}

//MARK:- TimeFormattingForTimer
func timeFormatted(_ totalSeconds: Int) -> String {
    let seconds: Int = totalSeconds % 60
    let minutes: Int = (totalSeconds / 60) % 60
    return String(format: "%02d:%02d", minutes, seconds)
}

//MARK: ForDelay
func delay(seconds: Double, completion: @escaping () -> ()) {
  DispatchQueue.main.asyncAfter(deadline: .now() + seconds) {
    completion()
  }
}
