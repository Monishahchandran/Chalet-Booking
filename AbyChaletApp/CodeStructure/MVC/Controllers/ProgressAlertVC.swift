//
//  ProgressAlertVC.swift
//  AbyChaletApp
//
//  Created by Visakh on 11/05/21.
//

import UIKit
import Foundation

class ProgressAlertVC: UIViewController {

    @IBOutlet weak var alertTitle: UILabel!
    @IBOutlet weak var activityIndicator: UIActivityIndicatorView!
    @IBOutlet weak var alertPopUpView: UIView!
    var message:String?
    var show:Bool?
    override func viewDidLoad() {
        super.viewDidLoad()
        setUpForAlert()
        activityIndicator.hidesWhenStopped = true
    }
 
    
    func setUpForAlert(){
        if show ?? false {
            alertTitle.text = message ?? ""
            activityIndicator.startAnimating()
        }else {
            removePopup()
        }
    }
    override func viewDidLayoutSubviews() {
        super.viewDidLayoutSubviews()
        alertPopUpView.addCornerForView(cornerRadius: 10)
    }
}

//MARK:- DismissingAlertSetup
extension ProgressAlertVC {
    override func touchesBegan(_ touches: Set<UITouch>, with event: UIEvent?) {
        let touch: UITouch? = touches.first
        if touch?.view != alertPopUpView {
             self.removePopup()
        }
    }
    
    func removePopup(){
        activityIndicator.stopAnimating()
        self.willMove(toParent: nil)
        self.view.removeFromSuperview()
        self.removeFromParent()
        self.dismiss(animated: true, completion: nil)
    }
}
