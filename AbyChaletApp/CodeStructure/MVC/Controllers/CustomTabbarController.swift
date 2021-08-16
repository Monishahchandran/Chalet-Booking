//
//  CustomTabbarController.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 28/04/21.
//

import UIKit
import SDWebImage

class CustomTabbarController: UITabBarController {

    let imagee = UIImage(named: "icn_profile")?.withRenderingMode(.alwaysOriginal)
    let selectedImage = UIImage(named: "icn_SelectedProfile")
    let selectedImageLogin = UIImage(named: "icn_profile")
    override func viewDidLoad() {
        super.viewDidLoad()

        /*let packageListVC = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(identifier: "PackageListViewController") as! PackageListViewController
        let item1 = UINavigationController(rootViewController: packageListVC)
        self.viewControllers![0] = item1
        //self.tabBar.items![0].title = "Home".localized()
       // self.tabBar.items![1].title = "Bookings".localized()
        //self.tabBar.items![2].title = "Offers".localized()
        //self.tabBar.items![3].title = "Profile".localized()
        self.tabBar.items![3].image = UIImage(named: "icn_Home")?.withRenderingMode(.alwaysOriginal).withTintColor(.lightGray)
        self.tabBar.isTranslucent = false*/
        let packageListVC = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(identifier: "PackageListViewController") as! PackageListViewController
        let item1 = UINavigationController(rootViewController: packageListVC)
        self.viewControllers![0] = item1
        self.tabBar.items![0].title = "Home"
        self.tabBar.items![0].image = UIImage(named: "icn_Home")?.withRenderingMode(.alwaysOriginal).withTintColor(.lightGray)
        self.tabBar.isTranslucent = false
        
        
        
    }
    
    override func viewWillAppear(_ animated: Bool) {
        super.viewWillAppear(animated)
        /*let packageListVC = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(identifier: "PackageListViewController") as! PackageListViewController
        let item1 = UINavigationController(rootViewController: packageListVC)
        self.viewControllers![0] = item1
        self.tabBar.items![0].title = "Home"
        self.tabBar.items![0].image = UIImage(named: "icn_Home")?.withRenderingMode(.alwaysOriginal).withTintColor(.lightGray)*/
        
        
        
        
        if (UserDefaults.standard.object(forKey: "kCurrentUserDetails") != nil) {
            let profileVC = UIStoryboard(name: "ProfileNew", bundle: Bundle.main).instantiateViewController(identifier: "MyProfileContainerVC") as! MyProfileContainerVC
            let item4 = UINavigationController(rootViewController: profileVC)
            self.viewControllers![3] = item4
            self.tabBar.items![3].title = "Profile"
            //self.tabBar.items![3].image = imagee
            let imgView = UIImageView()
           
            if CAUser.currentUser.profile_pic != ""{
                /*imgView.sd_setImage(with: URL(string: CAUser.currentUser.profile_pic!), placeholderImage: kPlaceHolderImage, options: .highPriority) { image, Error, cache, url in
                    if image != nil{
                        let img  = self.ResizeImage(image: image!, targetSize: CGSize(width: 30, height: 30))
                        self.tabBar.items![3].image = img.withRenderingMode(.alwaysOriginal)
                        
                    }else{
                        self.tabBar.items![3].image = kPlaceHolderImage
                    }
                }*/
                URLSession.shared.dataTask(with: URL(string: CAUser.currentUser.profile_pic!)!) { data, response, error in
                    guard
                        let httpURLResponse = response as? HTTPURLResponse, httpURLResponse.statusCode == 200,
                        let mimeType = response?.mimeType, mimeType.hasPrefix("image"),
                        let data = data, error == nil,
                        let image = UIImage(data: data)
                        else {
                        DispatchQueue.main.async {
                            self.tabBar.items![3].image = self.imagee
                        }
                        return
                    }
                    DispatchQueue.main.async() { [weak self] in
                        if image != nil{
                            self!.tabBar.items![3].image = image.resizeImageWith(newSize: CGSize(width: 30, height:   30)).withRenderingMode(.alwaysOriginal)
                        }else{
                            self!.tabBar.items![3].image = self?.imagee
                        }
                    }
                }.resume()

            }else{
                self.tabBar.items![3].image = imagee
            }
            
        }else{
            self.tabBar.items![3].image = imagee
        }
        
        NotificationCenter.default.addObserver(self, selector: #selector(updateProfile), name: NSNotification.Name(rawValue: NotificationNames.kUpdateProfile), object: nil)
    }

    
    
    

    @objc func updateProfile() {
        
        if (UserDefaults.standard.object(forKey: "kCurrentUserDetails") != nil) {
            let profileVC = UIStoryboard(name: "ProfileNew", bundle: Bundle.main).instantiateViewController(identifier: "MyProfileContainerVC") as! MyProfileContainerVC
            let item4 = UINavigationController(rootViewController: profileVC)
            self.viewControllers![3] = item4
            self.tabBar.items![3].title = "Profile"
            //self.tabBar.items![3].image = imagee
            let imgView = UIImageView()
           
            if CAUser.currentUser.profile_pic != ""{
                /*imgView.sd_setImage(with: URL(string: CAUser.currentUser.profile_pic!), placeholderImage: kPlaceHolderImage, options: .highPriority) { image, Error, cache, url in
                    if image != nil{
                        let img  = self.ResizeImage(image: image!, targetSize: CGSize(width: 30, height: 30))
                        self.tabBar.items![3].image = img.withRenderingMode(.alwaysOriginal)
                        
                    }else{
                        self.tabBar.items![3].image = kPlaceHolderImage
                    }
                }*/
                URLSession.shared.dataTask(with: URL(string: CAUser.currentUser.profile_pic!)!) { data, response, error in
                    guard
                        let httpURLResponse = response as? HTTPURLResponse, httpURLResponse.statusCode == 200,
                        let mimeType = response?.mimeType, mimeType.hasPrefix("image"),
                        let data = data, error == nil,
                        let image = UIImage(data: data)
                        else {
                        DispatchQueue.main.async {
                            self.tabBar.items![3].image = self.imagee
                        }
                        return
                    }
                    DispatchQueue.main.async() { [weak self] in
                        if image != nil{
                            self!.tabBar.items![3].image = image.resizeImageWith(newSize: CGSize(width: 30, height:   30)).withRenderingMode(.alwaysOriginal)
                        }else{
                            self!.tabBar.items![3].image = self?.imagee
                        }
                    }
                }.resume()

            }else{
                self.tabBar.items![3].image = imagee
            }
            
        }else{
            self.tabBar.items![3].image = imagee
        }
    }
    
    
    override func tabBar(_ tabBar: UITabBar, didSelect item: UITabBarItem) {
        
        if(item.title! == "Profile"){
            if (UserDefaults.standard.object(forKey: "kCurrentUserDetails") != nil) {
                if CAUser.currentUser.profile_pic != "" {
                    URLSession.shared.dataTask(with: URL(string: CAUser.currentUser.profile_pic!)!) { data, response, error in
                        guard
                            let httpURLResponse = response as? HTTPURLResponse, httpURLResponse.statusCode == 200,
                            let mimeType = response?.mimeType, mimeType.hasPrefix("image"),
                            let data = data, error == nil,
                            let image = UIImage(data: data)
                        else {
                            DispatchQueue.main.async {
                                self.tabBar.items![3].image = self.imagee
                            }
                            return
                            
                        }
                        DispatchQueue.main.async() { [weak self] in
                            if image != nil{
                                item.selectedImage = image.resizeImageWith(newSize: CGSize(width: 30, height:   30)).withRenderingMode(.alwaysOriginal)
                            }else{
                                item.selectedImage = self?.imagee
                            }
                        }
                    }.resume()
                }else{
                    item.selectedImage = imagee
                }
            }else{
                item.selectedImage = imagee
                
            }
        }else if(item.title! == "Home"){
            item.selectedImage = UIImage(named: "icn_Home")?.withRenderingMode(.alwaysOriginal).withTintColor(.white)
        }
    }
}
extension UIImage{
    func roundedImageWithBorder(width: CGFloat, color: UIColor) -> UIImage? {
           // let square = CGSize(width: min(size.width, size.height) + width * 2, height: min(size.width, size.height) + width * 2)
            let square = CGSize(width: 40, height: 40)
            let imageView = UIImageView(frame: CGRect(origin: CGPoint(x: 0, y: 0), size: square))
            imageView.contentMode = .center
            imageView.image = self
            imageView.layer.cornerRadius = square.width/2
            imageView.layer.masksToBounds = true
            imageView.layer.borderWidth = width
            imageView.layer.borderColor = color.cgColor
            UIGraphicsBeginImageContextWithOptions(imageView.bounds.size, false, scale)
            guard let context = UIGraphicsGetCurrentContext() else { return nil }
            imageView.layer.render(in: context)
            var result = UIGraphicsGetImageFromCurrentImageContext()
            UIGraphicsEndImageContext()
        result = result?.withRenderingMode(UIImage.RenderingMode.alwaysOriginal)
            return result
        }
    
    func tabBarImageWithCustomTint(tintColor: UIColor) -> UIImage {
            UIGraphicsBeginImageContextWithOptions(self.size, false, self.scale)
            let context: CGContext = UIGraphicsGetCurrentContext()!
            context.translateBy(x: 0, y: self.size.height)
            context.scaleBy(x: 1.0, y: -1.0)
            context.setBlendMode(CGBlendMode(rawValue: 1)!)
            let rect: CGRect = CGRect(x: 0, y: 0, width:  self.size.width, height: self.size.height)
            context.clip(to: rect, mask: self.cgImage!)
            tintColor.setFill()
            context.fill(rect)
            var newImage: UIImage = UIGraphicsGetImageFromCurrentImageContext()!
            UIGraphicsEndImageContext()
        newImage = newImage.withRenderingMode(UIImage.RenderingMode.alwaysOriginal)
            return newImage
        }
    func imageResized(to size: CGSize) -> UIImage {
            return UIGraphicsImageRenderer(size: size).image { _ in
                draw(in: CGRect(origin: .zero, size: size))
            }
        }
    
    func scaled(with scale: CGFloat) -> UIImage? {
            // size has to be integer, otherwise it could get white lines
            let size = CGSize(width: floor(self.size.width * scale), height: floor(self.size.height * scale))
            UIGraphicsBeginImageContext(size)
            draw(in: CGRect(x: 0, y: 0, width: size.width, height: size.height))
            let image = UIGraphicsGetImageFromCurrentImageContext()
            UIGraphicsEndImageContext()
            return image
        }
}
extension UIImageView{
    func downloadImage(url:String){
      //remove space if a url contains.
        let stringWithoutWhitespace = url.replacingOccurrences(of: " ", with: "%20", options: .regularExpression)
        self.sd_imageIndicator = SDWebImageActivityIndicator.gray
        self.sd_setImage(with: URL(string: stringWithoutWhitespace), placeholderImage: UIImage())
    }
}
extension UIImageView {
    func downloaded(from url: URL, contentMode mode: ContentMode = .scaleAspectFit) {
        contentMode = mode
        URLSession.shared.dataTask(with: url) { data, response, error in
            guard
                let httpURLResponse = response as? HTTPURLResponse, httpURLResponse.statusCode == 200,
                let mimeType = response?.mimeType, mimeType.hasPrefix("image"),
                let data = data, error == nil,
                let image = UIImage(data: data)
                else { return }
            DispatchQueue.main.async() { [weak self] in
                self?.image = image
                
                
                
            }
        }.resume()
    }
    func downloaded(from link: String, contentMode mode: ContentMode = .scaleAspectFit) {
        guard let url = URL(string: link) else { return }
        downloaded(from: url, contentMode: mode)
    }
}
extension UIImage{
    var roundedImage: UIImage {
        
        let newSize = CGSize(width: 30, height: 30)
        let rect = CGRect(origin:CGPoint(x: 0, y: 0), size: self.size)
        UIGraphicsBeginImageContextWithOptions(self.size, false, 1)
        UIBezierPath(
            roundedRect: rect,
            cornerRadius: self.size.height
        ).addClip()
        self.draw(in: rect)
        return UIGraphicsGetImageFromCurrentImageContext()!
    }
    
    
    func resizeImageWith(newSize: CGSize) -> UIImage {
        let scale = newSize.width / self.size.width
        let newHeight = self.size.height * scale
        //UIGraphicsBeginImageContext(CGSize(width: newWidth, height: newHeight))
        //image.draw(in: CGRect(x: 0, y: 0, width: newWidth, height: newHeight))
        UIGraphicsBeginImageContextWithOptions(newSize, false, 0.0)
        self.draw(in: CGRect(x: 0, y: 0, width: 30, height: 30))
        
        let rect = CGRect(origin:CGPoint(x: 0, y: 0), size: newSize)
        
        
        var newImage = UIGraphicsGetImageFromCurrentImageContext()
        UIGraphicsBeginImageContextWithOptions(newSize, false, 0.0)
        UIBezierPath(
            roundedRect: rect,
            cornerRadius: newSize.height
        ).addClip()
        self.draw(in: rect)
        newImage = UIGraphicsGetImageFromCurrentImageContext()
        UIGraphicsEndImageContext()
        
        return newImage!
    }
    
}
