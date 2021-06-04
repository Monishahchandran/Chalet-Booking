//
//  ReservationTableViewVC.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 14/05/21.
//

import UIKit

class ReservationTableViewVC: UIViewController {

   /* @IBOutlet weak var collectionViewForBooking: UICollectionView!
    @IBOutlet weak var tblViewForBooking: UITableView!
    
    @IBOutlet weak var viewForTopLeftRightArrow: UIView!
    @IBOutlet weak var btnLeftArrow: UIButton!
    @IBOutlet weak var btnRightArrow: UIButton!
    //MARK:cell1
    @IBOutlet weak var viewForChalteImageCollection: UIView!
    @IBOutlet weak var lblForChaletNumber: UILabel!
    @IBOutlet weak var lblForChaletName: UILabel!
    @IBOutlet weak var collectionForImage: UICollectionView!
    //MARK: cell3
    @IBOutlet weak var lblForCheckOutDate: UILabel!
    @IBOutlet weak var lblForCheckOutTime: UILabel!
    @IBOutlet weak var lblForCheckInDate: UILabel!
    @IBOutlet weak var lblForCheckInTime: UILabel!
    //MARK: cell5
    @IBOutlet weak var lblForCurrencyTypeRentalPrice: UILabel!
    @IBOutlet weak var lblForCurrencyAmountRentalPrice: UILabel!
    @IBOutlet weak var lblForRentalPriceTitle: UILabel!
    @IBOutlet weak var lblForNoDeposit: UILabel!
    
    @IBOutlet weak var lblForAmountTotalRewards: UILabel!
    @IBOutlet weak var lblForTotalRewardCurrenctType: UILabel!
    @IBOutlet weak var lblForTotalRewardTitle: UILabel!
    
    @IBOutlet weak var lblForTotalInvoiceCurrencyType: UILabel!
    @IBOutlet weak var lblForTotalInvoiceAmount: UILabel!
    @IBOutlet weak var lblForTotalInvoiceTitle: UILabel!
    
    //MARK: Cell7
    @IBOutlet weak var lblForCurrencyTypeRentalPrice1: UILabel!
    @IBOutlet weak var lblForCurrencyAmountRentalPrice1: UILabel!
    @IBOutlet weak var lblForRentalPriceTitle1: UILabel!
    
    @IBOutlet weak var lblForCurrencyTypeDeposit1: UILabel!
    @IBOutlet weak var lblForDepositAmount1: UILabel!
    @IBOutlet weak var lblForDepositTitle1: UILabel!
    @IBOutlet weak var btnForDepositSelection1: UIButton!
    
    @IBOutlet weak var lblForTotalRewardCurrenctType1: UILabel!
    @IBOutlet weak var lblForAmountTotalRewards1: UILabel!
    @IBOutlet weak var lblForTotalRewardTitle1: UILabel!
    
    @IBOutlet weak var lblForTotalInvoiceCurrencyType1: UILabel!
    @IBOutlet weak var lblForTotalInvoiceAmount1: UILabel!
    @IBOutlet weak var lblForTotalInvoiceTitle1: UILabel!

    //MARK: cell9
    @IBOutlet weak var lblForCurrencyTypeRentalPrice2: UILabel!
    @IBOutlet weak var lblForCurrencyAmountRentalPrice2: UILabel!
    @IBOutlet weak var lblForRentalPriceTitle2: UILabel!
    
    @IBOutlet weak var lblForCurrencyTypeDeposit2: UILabel!
    @IBOutlet weak var lblForDepositAmount2: UILabel!
    @IBOutlet weak var lblForDepositTitle2: UILabel!
    @IBOutlet weak var btnForDepositSelection2: UIButton!
    
    @IBOutlet weak var lblForDepositDetailsTitle: UILabel!
    @IBOutlet weak var lblForDepositDetailsTime: UILabel!
    @IBOutlet weak var lblForDepositDescription: UILabel!
    @IBOutlet weak var lblforBooking: UILabel!
    @IBOutlet weak var lblForCurrencyTypeRemaining2: UILabel!
    @IBOutlet weak var lblForRemainingAmount2: UILabel!
    @IBOutlet weak var lblForRemainingTitle2: UILabel!
    
    @IBOutlet weak var lblForTotalRewardCurrencyType2: UILabel!
    @IBOutlet weak var lblForAmountTotalRewards2: UILabel!
    @IBOutlet weak var lblForTotalRewardTitle2: UILabel!
    @IBOutlet weak var btnForToatlRewards2: UIButton!
    
    @IBOutlet weak var lblForTotalInvoiceCurrencyType2: UILabel!
    @IBOutlet weak var lblForTotalInvoiceAmount2: UILabel!
    @IBOutlet weak var lblForTotalInvoiceTitle2: UILabel!
    
    //MARK: cell11
    @IBOutlet weak var lblForCurrencyTypeRentalPrice3: UILabel!
    @IBOutlet weak var lblForCurrencyAmountRentalPrice3: UILabel!
    @IBOutlet weak var lblForRentalPriceTitle3: UILabel!
    
    @IBOutlet weak var lblForNoDeposit3: UILabel!
    
    @IBOutlet weak var lblForTotalRewardCurrenctType3: UILabel!
    @IBOutlet weak var lblForAmountTotalRewards3: UILabel!
    @IBOutlet weak var lblForTotalRewardTitle3: UILabel!
    @IBOutlet weak var btnForToatlRewards3: UIButton!

    @IBOutlet weak var lblForTotalInvoiceCurrencyType3: UILabel!
    @IBOutlet weak var lblForTotalInvoiceAmount3: UILabel!
    @IBOutlet weak var lblForTotalInvoiceTitle3: UILabel!
    
    //MARK: cell13
    @IBOutlet weak var lblForBookingDetailsTitle: UILabel!
    @IBOutlet weak var lblForCurrencyTypeRentalPrice4: UILabel!
    @IBOutlet weak var lblForCurrencyAmountRentalPrice4: UILabel!
    @IBOutlet weak var lblForRentalPriceTitle4: UILabel!
    
    @IBOutlet weak var lblForCurrencyTypeDeposit4: UILabel!
    @IBOutlet weak var lblForDepositAmount4: UILabel!
    @IBOutlet weak var lblForDepositTitle4: UILabel!
    @IBOutlet weak var btnForDepositSelection4: UIButton!
    
    @IBOutlet weak var lblForTotalRewardCurrenctType4: UILabel!
    @IBOutlet weak var lblForAmountTotalRewards4: UILabel!
    @IBOutlet weak var lblForTotalRewardTitle4: UILabel!
    @IBOutlet weak var btnForToatlRewards4: UIButton!
    
    @IBOutlet weak var lblForTotalInvoiceCurrencyType4: UILabel!
    @IBOutlet weak var lblForTotalInvoiceAmount4: UILabel!
    @IBOutlet weak var lblForTotalInvoiceTitle4: UILabel!
    
    //MARK: cell15
    @IBOutlet weak var lblForChaletDetailsTitle: UILabel!
    @IBOutlet weak var lblChaletDetails1: UILabel!
    @IBOutlet weak var lblChaletDetails2: UILabel!
    @IBOutlet weak var lblChaletDetails3: UILabel!
    @IBOutlet weak var lblChaletDetails4: UILabel!
    @IBOutlet weak var lblChaletDetails5: UILabel!
    
    //MARK: Cell
    @IBOutlet weak var lblAgreementTitle: UILabel!
    @IBOutlet weak var lblAgreementDiscription: UILabel!
    @IBOutlet weak var lblGeneralNotes1: UILabel!
    @IBOutlet weak var btnGeneralNotes1: UIButton!
    @IBOutlet weak var lblGeneralNotes2: UILabel!
    @IBOutlet weak var btnGeneralNotes2: UIButton!
    @IBOutlet weak var lblGeneralNotes3: UILabel!
    @IBOutlet weak var btnGeneralNotes3: UIButton!
    @IBOutlet weak var lblGeneralNotes4: UILabel!
    @IBOutlet weak var btnGeneralNotes4: UIButton!
    @IBOutlet weak var lblAgreeTermsOfService: UILabel!
    @IBOutlet weak var btnAgreeTermsAndServices: UIButton!
    
    @IBOutlet weak var btnPaymentNow: UIButton!*/
    
    override func viewDidLoad() {
        super.viewDidLoad()

        // Do any additional setup after loading the view.
    }
    

    
    
}
