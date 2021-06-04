//
//  IntrolCollectionViewCell.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 23/04/21.
//

import UIKit

class IntrolCollectionViewCell: UICollectionViewCell {
    @IBOutlet weak var imgViewForIntroImg: UIImageView!
    @IBOutlet weak var lblIntroText: UILabel!
    @IBOutlet weak var btnEnjoy: UIButton!
    @IBOutlet weak var pageControl: UIPageControl!
    var indexPathItem:Int?
    var introScreenData: IntroScreenStruct! {
        didSet {
            lblIntroText.text = introScreenData.title.localized()
            imgViewForIntroImg.image = introScreenData.IntroImg
            btnEnjoy.isHidden = introScreenData.isButtonHide
        }
    }
    
    override func awakeFromNib() {
    }
}

class IntrolCollectionViewSecondCell: UICollectionViewCell {
    @IBOutlet weak var imgViewForIntroImg: UIImageView!
    @IBOutlet weak var lblIntroText: UILabel!
    @IBOutlet weak var buttonEnjoy: UIButton!
    @IBOutlet weak var pageControl: UIPageControl!
    var indexPathItem:Int?
    var introScreenData: IntroScreenStruct! {
        didSet {
            lblIntroText.text = introScreenData.title
            imgViewForIntroImg.image = introScreenData.IntroImg
            buttonEnjoy.isHidden = introScreenData.isButtonHide
        }
    }
    @IBAction func btnEnjoyDidTap(_ sender: Any) {
        
        /*appDelegate.window?.rootViewController?.dismiss(animated: true, completion: nil)
        let tabBarVC = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(identifier: "CustomTabbarController") as! CustomTabbarController
        //let item1 = UINavigationController(rootViewController: tabBarVC)
        appDelegate.window?.rootViewController = tabBarVC
        appDelegate.window?.makeKeyAndVisible()*/
        
        let storyboard = UIStoryboard.init(name: "Main", bundle: nil)
        let loginScreen = storyboard.instantiateViewController(withIdentifier: "CustomTabbarController") as! CustomTabbarController
        
        loginScreen.selectedIndex =  0
        appDelegate.window?.rootViewController = loginScreen
    }

    override func layoutSubviews() {
        super.layoutSubviews()
        buttonEnjoy.addCorner()
        buttonEnjoy.addBorder()
        buttonEnjoy.addShadow()
    }
}
