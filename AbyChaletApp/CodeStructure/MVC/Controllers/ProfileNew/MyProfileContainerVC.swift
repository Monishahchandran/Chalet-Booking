//
//  MyProfileContainerVC.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 18/05/21.
//

import UIKit

class MyProfileContainerVC: UIViewController {
    var btnMessage = UIButton()

    override func viewDidLoad() {
        super.viewDidLoad()
        
        self.navigationController?.navigationBar.isHidden = false
        self.navigationItem.setHidesBackButton(true, animated: true)

        setupForCustomNavigationTitle(self: self)
        addBarButtons()
    }

    
    func addBarButtons() {
        btnMessage = UIButton(type: .custom)
        btnMessage.frame = CGRect(x: 0, y: 0, width: 44, height: 44)
        btnMessage.setImage(UIImage(named: "icn_Message"), for: .normal)
        btnMessage.addTarget(self, action: #selector(btnMessageDidTap(sender:)), for: .touchUpInside)
        let barButtonSettings = UIBarButtonItem(customView: btnMessage)
        navigationController?.navigationBar.barTintColor = kAppHeaderColor
        navigationController?.navigationBar.isTranslucent = false
        self.navigationItem.rightBarButtonItem = barButtonSettings
    }
    
    @objc func btnMessageDidTap(sender: UIButton) {
        
    }

    
    
    
}
